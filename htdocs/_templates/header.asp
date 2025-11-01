<%
' Builds up a navigation bar item that doesn't include a spacer.
Function NavItemNoSpacer(strLabel, strHref)
	NavItemNoSpacer = "<span class=""item""><a href=""" & strHref & """>" & _
		strLabel & "</a></span>"
End Function

' Builds up a navigation bar item.
Function NavItem(strLabel, strHref)
	NavItem = vbCrLf & "<span class=""spacer"">|</span>" & vbCrLf & _
		NavItemNoSpacer(strLabel, strHref)
End Function
%>
<div id="header">
	<!-- Title header block. -->
	<div id="title-head">
		<h1>Nathan Campos</h1>
		<?php
			require_once __DIR__ . '/../src/breadcrumbs.php';
			echo breadcrumbs(isset($crumbs) ? $crumbs : breadcrumbs_fromreq());
		?>
	</div>

	<!-- Navigation bar. -->
	<div id="navbar">
		<%= NavItemNoSpacer("index", "/") %>
		<%= NavItem("gopher", "gopher://nathancampos.me:70/1/") %>
		<%= NavItem("projects", "/projects") %>
		<%= NavItem("log", "/log") %>
		<%= NavItem("links", "/links") %>
		<%= NavItem("wiki", "//wiki.nathancampos.me/") %>
		<%= NavItem("work", "//innoveworkshop.com/") %>
		<%= NavItem("meta", "/meta") %>
		<%= NavItem("contact", "/contact") %>
	</div>

	<hr>
</div>

<div id="content">
