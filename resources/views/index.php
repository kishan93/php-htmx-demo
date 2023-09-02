<!DOCTYPE html>
<html>
<head>
<title>HTMX Demo</title>
<script src="https://unpkg.com/htmx.org@1.9.4"></script>
</head>
<body>

    <button hx-post="/clicked" hx-swap="innerHTML">
        Click Me
    </button>

</body>
</html>
