<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GithubController extends Controller
{
    protected $GH_USERNAME = 'jstalinko';
    protected $ghClient;
    protected $GH_TOKEN;

    public function __construct()
    {
        $this->ghClient = new \Github\Client();
        $this->GH_TOKEN = env('GITHUB_ACCESS_TOKEN');
        // auth
        $this->ghClient->authenticate($this->GH_TOKEN, null, \Github\AuthMethod::ACCESS_TOKEN);
    }
    public function getReleases(Request $request): JsonResponse
    {
        $repoName = $request->repo;
        return response()->json($this->ghCollection('release', ['repoName' => $repoName]), 200, [], JSON_PRETTY_PRINT);
    }
    public function getAssets(Request $request): JsonResponse
    {
        $releaseId = $request->releaseid;
        $repoName = $request->repo;
        return response()->json($this->ghCollection('asset', ['releaseId' => $releaseId, 'repoName' => $repoName]), 200, [], JSON_PRETTY_PRINT);
    }

    public function getRepos()
    {
        return response()->json($this->ghCollection('repo', []), 200, [], JSON_PRETTY_PRINT);
    }

    public function ghCollection($method = 'repo', $params = []): array
    {
        if ($method == 'repo') {
            return $this->ghClient->api('me')->repositories($this->GH_USERNAME);
        } else if ($method == 'asset') {
            return $this->ghClient->api('repo')->releases()->assets()->all($this->GH_USERNAME, $params['repoName'], $params['releaseId']);
        } else if ($method == 'release') {
           //dd($params);
            return $this->ghClient->api('repo')->releases()->latest($this->GH_USERNAME, $params['repoName']);
        }
    }
}
