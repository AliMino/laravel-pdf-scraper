<!DOCTYPE html>
<html>
<head>
  <title>API Documentation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.15.5/swagger-ui-bundle.js"></script>
</head>
<body>
  <div id="swagger-ui"></div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      SwaggerUIBundle({
        url: "{{ asset('open-api.json') }}", // Path to your OpenAPI JSON file
        dom_id: "#swagger-ui",
      });
    });
  </script>
</body>
</html>
