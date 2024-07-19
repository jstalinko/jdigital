<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>JavaraDigital</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <meta name="csrf-token" content="{{csrf_token()}}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">
<style>.titillium-web-extralight {
  font-family: "Titillium Web", sans-serif;
  font-weight: 200;
  font-style: normal;
}

.titillium-web-light {
  font-family: "Titillium Web", sans-serif;
  font-weight: 300;
  font-style: normal;
}

.titillium-web-regular {
  font-family: "Titillium Web", sans-serif;
  font-weight: 400;
  font-style: normal;
}

.titillium-web-semibold {
  font-family: "Titillium Web", sans-serif;
  font-weight: 600;
  font-style: normal;
}

.titillium-web-bold {
  font-family: "Titillium Web", sans-serif;
  font-weight: 700;
  font-style: normal;
}

.titillium-web-black {
  font-family: "Titillium Web", sans-serif;
  font-weight: 900;
  font-style: normal;
}

.titillium-web-extralight-italic {
  font-family: "Titillium Web", sans-serif;
  font-weight: 200;
  font-style: italic;
}

.titillium-web-light-italic {
  font-family: "Titillium Web", sans-serif;
  font-weight: 300;
  font-style: italic;
}

.titillium-web-regular-italic {
  font-family: "Titillium Web", sans-serif;
  font-weight: 400;
  font-style: italic;
}

.titillium-web-semibold-italic {
  font-family: "Titillium Web", sans-serif;
  font-weight: 600;
  font-style: italic;
}

.titillium-web-bold-italic {
  font-family: "Titillium Web", sans-serif;
  font-weight: 700;
  font-style: italic;
}

.montserrat {
  font-family: "Montserrat", sans-serif;
  font-optical-sizing: auto;
}
p{
  font-family: "Montserrat",sans-serif;
}

</style>
    @inertiaHead
  </head>
  <body class="dark:dark:bg-[#102A43] dark:text-[#BCCCDC]">
    @inertia
  </body>
</html>