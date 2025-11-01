<%
Dim fso
Dim currentFile
Dim lastMod

Set fso = CreateObject("Scripting.FileSystemObject")
Set currentFile = fso.GetFile(Request.ServerVariables("PATH_TRANSLATED"))
lastMod = currentFile.DateLastModified
%>

<div id="footer">
	<hr>
	<div class="copyright">
		Nathan Campos &#169; 2024-<%= Year(Date) %>
	</div>
	<div class="last-modified">
		Last modified: <%= Year(lastMod) %>-<%= Month(lastMod) %>-<%= Day(lastMod) %>
			<%= " " & FormatDateTime(lastMod, vbShortTime) %>

		<?= date('Y-m-d H:i', isset($last_modified) ?
			$last_modified : getlastmod()) ?>
	</div>
</div>
