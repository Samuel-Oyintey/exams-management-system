<!doctype html>
<html lang="en">
  <head>
  	<% base_tag %>
	$MetaTags(false)
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
  </head>
  <body>
    <% include Header %>

	$Layout
  </body>
</html>