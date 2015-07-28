<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bucket #{{ $bucket->id }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css" media="screen">
    .header {
      text-align: center;
      background: #
    }
    .footer {
      padding: 60px;
    }
  </style>
</head>
<body>
  <div class="container">
    <header class="header">
      <h1>Bucket #{{ $bucket->id }}</h1>
      <h2>Results</h2>
    </header>
    @foreach ($assets as $asset)
      <article>
        <h3>{{ $asset->by }}'s <small>submission</small></h3>
        <pre>{{ unserialize($asset->content) }}</pre>
      </article>
    @endforeach
    <footer class="footer text-center">
      <small>A quick stunt by <a href="http://viget.com/about/team/tmarshall">Tommy</a> for <a href="http://viget.com">Viget</a></small>
    </footer>
  </div>
</body>
</html>
