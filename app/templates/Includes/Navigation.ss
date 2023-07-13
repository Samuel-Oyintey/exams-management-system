<nav class="primary">
	<span class="nav-open-button">²</span>
	<ul>
		<% loop $Menu(1) %>
			<li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a></li>
		<% end_loop %>
		<li class="$LinkingMode"><a href="Security/login?BackURL=dashboard" title="$Title.XML">Login</a></li>
		<li class="$LinkingMode"><a href="register" title="$Title.XML">Register</a></li>
	</ul>
</nav>
