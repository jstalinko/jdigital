<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $releases = $this->ghClient->api('repo')
            ->releases()
            ->latest($this->GH_USERNAME, $repoName);
        return response()->json($releases, 200, [], JSON_PRETTY_PRINT);
    }
    public function getAssets(Request $request): JsonResponse
    {
        $releaseId = $request->releaseid;
        $repoName = $request->repo;
        $assets = $this->ghClient->api('repo')
            ->releases()
            ->all($this->GH_USERNAME, $repoName, $releaseId);
        return response()->json($assets, 200, [], JSON_PRETTY_PRINT);
    }

    public function getRepos(): JsonResponse
    {
        $repos = $this->ghClient->api('me')->repositories($this->GH_USERNAME);

        return response()->json($repos, 200, [], JSON_PRETTY_PRINT);
    }
}
