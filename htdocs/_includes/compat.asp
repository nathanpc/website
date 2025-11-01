<%
' Creates a compatible image element with HTML properties.
Sub CompatImageWithProps(strHref, strAlt, strProps)
	Response.Write("<a href=""" & strHref & """><img src=""" & strHref & _
		""" alt=""" & strAlt & """ " & strProps & "></a>")
	'	"_compat.gif"" alt=""" & strAlt & """ " & strProps & "></a>")
End Sub

' Creates a generic compatible image element.
Sub CompatImage(strHref, strAlt)
	CompatImageWithProps strAlt, strHref, ""
End Sub
%>
