// Compacted by ScriptingMagic.com
var viewToggle = -1;
var htmlText;
window.onload = function () {
    var a;
    Init();
    document.getElementById("vsource").onclick = viewSource1;
};

function Init() {
    obj = document.getElementById("rte");
    obj.contentWindow.document.designMode = "On";
    obj.contentWindow.document.open();
    obj.contentWindow.document.write('<head><meta http-equiv="Content-Type" content="text/html; UTF-8" /><style type="text/css">body{ font-family:arial; font-size:12px; }</style> </head>');
    obj.contentWindow.document.close()
}

function viewSource1() {
        document.getElementById("vsource").style.display = "none";
        document.getElementById("go").style.display = "block";
        htmlText = obj.contentWindow.document.body.innerHTML;
        prepareString(htmlText);
        removeString(htmlText);
        massageString(htmlText);
        cleanUp(htmlText);
        addBreaks(htmlText);
        encodeString(htmlText);
        htmlText = htmlText.replace(new RegExp("<", "gi"), "&lt;");
        htmlText = htmlText.replace(new RegExp(">", "gi"), "&gt;");
        htmlText = htmlText.replace(new RegExp("x---rn---x", "gi"), "<br />\n");
        obj.contentWindow.document.body.innerHTML = htmlText;
        obj.contentWindow.focus()

       // document.getElementById("vsource2").style.display = "none";
       // document.getElementById("vsource").style.display = "block";
        var a = (document.getElementsByTagName("body")[0].innerText != undefined) ? true : false;
        if (!a) {
            richText = obj.contentWindow.document.body.textContent
        } else {
            richText = obj.contentWindow.document.body.innerText
        }
        obj.contentWindow.document.body.innerHTML = richText;
        obj.contentWindow.focus()
		
		var iframe = document.getElementById("rte");
		var iframe_contents = iframe.contentDocument.body.innerHTML;
		document.getElementById("description").innerHTML=iframe_contents;
   
}

function prepareString() {
    htmlText = htmlText.replace(new RegExp("\r\n", "gi"), " ");
    htmlText = htmlText.replace(new RegExp("\n", "gi"), " ");
    //htmlText = htmlText.replace(new RegExp("\t", "gi"), " ");
    //htmlText = htmlText.replace(new RegExp("&nbsp;", "gi"), " ");
    var a = /\s+/g;
    htmlText = htmlText.replace(a, " ");
    var a = /\s+/g;
    htmlText = htmlText.replace(a, " ");
    var b = /&amp;/g;
    htmlText = htmlText.replace(b, "&amp;amp;");
    var c = /&gt;/g;
    htmlText = htmlText.replace(c, "&amp;gt;");
    var d = /&lt;/g;
    htmlText = htmlText.replace(d, "&amp;lt;")
}

function removeString() {
    htmlText = htmlText.replace(/<!(?:--[\s\S]*?--\s*)?>\s*/g, "");
    var a = "\\<\\?xmls*.*?/>";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var b = "<[A-Za-z]:.*?>";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "</[A-Za-z]:.*?>";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "<[A-Za-z][A-Za-z]:.*?>";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "</[A-Za-z][A-Za-z]:.*?>";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "<[A-Za-z][A-Za-z][0-9]:.*?>";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "</[A-Za-z][A-Za-z][0-9]:.*?>";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    htmlText = htmlText.replace(new RegExp(' style=""', "gi"), "");
    htmlText = htmlText.replace(new RegExp('style=""', "gi"), "");
    var c = "<s*/?s*metas*.*?>";
    htmlText = htmlText.replace(new RegExp(c, "gi"), "");
    var d = "<s*/?s*links*.*?>";
    htmlText = htmlText.replace(new RegExp(d, "gi"), "");
    var e = "<s*/?s*styles*.*?>";
    htmlText = htmlText.replace(new RegExp(e, "gi"), "");
    var f = "<s*/?s*img s*.*?>";
    htmlText = htmlText.replace(new RegExp(f, "gi"), "");
    var g = "<s*/?s*div s*.*?>";
    htmlText = htmlText.replace(new RegExp(g, "gi"), "");
    var h = "<s*/s*divs*.*?>";
    htmlText = htmlText.replace(new RegExp(h, "gi"), "");
    htmlText = htmlText.replace(new RegExp("<div>", "gi"), "");
    var i = "<s*/?s*spans*.*?>";
    htmlText = htmlText.replace(new RegExp(i, "gi"), "");
    var j = "<s*/s*spans*.*?>";
    htmlText = htmlText.replace(new RegExp(j, "gi"), "");
    htmlText = htmlText.replace(new RegExp("<span>", "gi"), "");
    var k = "<s*/?s*font s*.*?>";
    htmlText = htmlText.replace(new RegExp(k, "gi"), "");
    var l = "<s*/s*fonts*.*?>";
    htmlText = htmlText.replace(new RegExp(l, "gi"), "");
    htmlText = htmlText.replace(new RegExp("<font>", "gi"), "");
    var m = "<u>";
    htmlText = htmlText.replace(new RegExp(m, "gi"), "");
    var n = "</u>";
    htmlText = htmlText.replace(new RegExp(n, "gi"), "");
    var o = 'class=".*?"';
    htmlText = htmlText.replace(new RegExp(o, "gi"), "");
    var o = "class='.*?'";
    htmlText = htmlText.replace(new RegExp(o, "gi"), "");
    var o = "class=.*? ";
    htmlText = htmlText.replace(new RegExp(o, "gi"), "");
    var p = 'style=".*?"';
    htmlText = htmlText.replace(new RegExp(p, "gi"), "");
    var p = "style='.*?'";
    htmlText = htmlText.replace(new RegExp(p, "gi"), "");
    var p = "style=.*? ";
    htmlText = htmlText.replace(new RegExp(p, "gi"), " ")
}

function cleanUp() {
    var a = 'width="[0-9][0-9][0-9][0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = "width=[0-9][0-9][0-9][0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = 'width="[0-9][0-9][0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = "width=[0-9][0-9][0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = 'width="[0-9][0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = "width=[0-9][0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = 'width="[0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = "width=[0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = 'width="[0-9]"';
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var a = "width=[0-9]";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "");
    var b = 'height="[0-9][0-9][0-9][0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "height=[0-9][0-9][0-9][0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = 'height="[0-9][0-9][0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "height=[0-9][0-9][0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = 'height="[0-9][0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "height=[0-9][0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = 'height="[0-9][0-9]"';
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "height=[0-9][0-9]";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = 'height="[0-9]"';
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var b = "height=[0-9]";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "");
    var c = 'bgcolor=".*?"';
    htmlText = htmlText.replace(new RegExp(c, "gi"), "");
    var d = htmlText.match(/a href=\".*?\"/gi);
    if (d) {
        for (var i = (d.length - 1); i > -1; i--) {
            if (d[i].indexOf("#") != -1) {
                var e = new Array();
                var f;
                e = d[i].split("#");
                f = 'href="#' + e[1];
                htmlText = htmlText.replace(d[i], f)
            }
        }
    }
    htmlText = htmlText.replace(new RegExp("<p >", "gi"), "<p>");
    htmlText = htmlText.replace(new RegExp("<p> ", "gi"), "<p>");
    htmlText = htmlText.replace(new RegExp("<h1 >", "gi"), "<h1>");
    htmlText = htmlText.replace(new RegExp("<h2 >", "gi"), "<h2>");
    htmlText = htmlText.replace(new RegExp("<h3 >", "gi"), "<h3>");
    htmlText = htmlText.replace(new RegExp("<h4 >", "gi"), "<h4>");
    htmlText = htmlText.replace(new RegExp("<h5 >", "gi"), "<h5>");
    htmlText = htmlText.replace(new RegExp("<h6 >", "gi"), "<h6>");
    htmlText = htmlText.replace(new RegExp("<table", "gi"), "<table");
    htmlText = htmlText.replace(new RegExp("</table", "gi"), "</table");
    htmlText = htmlText.replace(new RegExp("<tbody", "gi"), "<tbody");
    htmlText = htmlText.replace(new RegExp("</tbody", "gi"), "</tbody");
    htmlText = htmlText.replace(new RegExp("<tr >", "gi"), "<tr>");
    htmlText = htmlText.replace(new RegExp("<tr", "gi"), "<tr");
    htmlText = htmlText.replace(new RegExp("<td  >", "gi"), "<td>");
    htmlText = htmlText.replace(new RegExp("<td >", "gi"), "<td>");
    htmlText = htmlText.replace(new RegExp("<td", "gi"), "<td");
    htmlText = htmlText.replace(new RegExp("<td> <p>", "gi"), "<td><p>");
    htmlText = htmlText.replace(new RegExp("<b >", "gi"), "<b>");
    htmlText = htmlText.replace(new RegExp("<b", "gi"), "<b");
    htmlText = htmlText.replace(new RegExp("</b>", "gi"), "</b>");
    htmlText = htmlText.replace(new RegExp("<i >", "gi"), "<i>");
    htmlText = htmlText.replace(new RegExp("<i", "gi"), "<i");
    htmlText = htmlText.replace(new RegExp("</i>", "gi"), "</i>");
    htmlText = htmlText.replace(new RegExp("<em >", "gi"), "<em>");
    htmlText = htmlText.replace(new RegExp("<em", "gi"), "<em");
    htmlText = htmlText.replace(new RegExp("</em>", "gi"), "</em>");
    htmlText = htmlText.replace(new RegExp("<sup", "gi"), "<sup");
    htmlText = htmlText.replace(new RegExp("</sup>", "gi"), "</sup>");
    htmlText = htmlText.replace(new RegExp("<dfn", "gi"), "<dfn");
    htmlText = htmlText.replace(new RegExp("</dfn>", "gi"), "</dfn>");
    htmlText = htmlText.replace(new RegExp("<strong", "gi"), "<strong");
    htmlText = htmlText.replace(new RegExp("</strong>", "gi"), "</strong>");
    htmlText = htmlText.replace(new RegExp("<a ", "gi"), "<a ");
    htmlText = htmlText.replace(new RegExp("</a>", "gi"), "</a>");
    htmlText = htmlText.replace(new RegExp("vAlign", "gi"), "valign");
    htmlText = htmlText.replace(new RegExp("colSpan", "gi"), "colspan");
    htmlText = htmlText.replace(new RegExp("rowSpan", "gi"), "rowspan");
    htmlText = htmlText.replace(new RegExp("cellSpacing", "gi"), "cellspacing");
    htmlText = htmlText.replace(new RegExp("cellPadding", "gi"), "cellpadding");
    htmlText = htmlText.replace(new RegExp("<h", "gi"), "<h");
    htmlText = htmlText.replace(new RegExp("</h", "gi"), "</h");
    htmlText = htmlText.replace(new RegExp("<pre", "gi"), "<pre");
    htmlText = htmlText.replace(new RegExp("</pre>", "gi"), "</pre>");
    htmlText = htmlText.replace(new RegExp("<tt", "gi"), "<tt");
    htmlText = htmlText.replace(new RegExp("</tt>", "gi"), "</tt>");
    htmlText = htmlText.replace(new RegExp("</b><b>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("</strong><strong>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("</i><i>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("</em><em>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<td><br /></td>", "gi"), "<td></td>");
    htmlText = htmlText.replace(new RegExp("<b> </b>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<b></b>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<strong> </strong>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<strong></strong>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<i> </i>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<i></i>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<em> </em>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<em></em>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<p>  </p>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<p> </p>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<p></p>", "gi"), "");
    htmlText = htmlText.replace(new RegExp(">  <p>", "gi"), "><p>");
    htmlText = htmlText.replace(new RegExp("> <p>", "gi"), "><p>");
    htmlText = htmlText.replace(new RegExp("<h1> </h1>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<h1></h1>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<h2> </h2>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<h2></h2>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<h3> </h3>", "gi"), "");
    htmlText = htmlText.replace(new RegExp("<h3></h3>", "gi"), "")
}

function addBreaks() {
    htmlText = htmlText.replace(new RegExp("</p> </td>", "gi"), "</p></td>");
    htmlText = htmlText.replace(new RegExp("</p></td>", "gi"), "</pppzppp></td>");
    htmlText = htmlText.replace(new RegExp("</p>", "gi"), "</p>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("</pppzppp></td>", "gi"), "</p></td>");
    htmlText = htmlText.replace(new RegExp("</ul>", "gi"), "</ul>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("<ul>", "gi"), "<ul>x---rn---x");
    htmlText = htmlText.replace(new RegExp("</li>", "gi"), "</li>x---rn---x");
    htmlText = htmlText.replace(new RegExp("<br />", "gi"), "<br />x---rn---x");
    htmlText = htmlText.replace(new RegExp("</td>", "gi"), "</td>x---rn---x");
    htmlText = htmlText.replace(new RegExp("</tr>", "gi"), "</tr>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("<tr>", "gi"), "<tr>x---rn---x");
    htmlText = htmlText.replace(new RegExp("<tbody>", "gi"), "x---rn---x<tbody>x---rn---x");
    htmlText = htmlText.replace(new RegExp("</tbody>", "gi"), "</tbody>x---rn---x");
    htmlText = htmlText.replace(new RegExp("</table>", "gi"), "</table>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("</h1>", "gi"), "</h1>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("</h2>", "gi"), "</h2>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("</h3>", "gi"), "</h3>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("</h4>", "gi"), "</h4>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("</h5>", "gi"), "</h5>x---rn---xx---rn---x");
    htmlText = htmlText.replace(new RegExp("</h6>", "gi"), "</h6>x---rn---xx---rn---x")
}

function massageString() {
    var a = "<s*/?s*HR s*.*?>";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "<hr />");
    htmlText = htmlText.replace(new RegExp("<HR>", "gi"), "<hr />");
    var a = "<s*/?s*BR s*.*?>";
    htmlText = htmlText.replace(new RegExp(a, "gi"), "<br />");
    htmlText = htmlText.replace(new RegExp("<BR>", "gi"), "<br />");
    htmlText = htmlText.replace(new RegExp("</p>", "gi"), "<---/p--->");
    var b = "<s*/?s*p s*.*?>";
    htmlText = htmlText.replace(new RegExp(b, "gi"), "<p>");
    htmlText = htmlText.replace(new RegExp("<---/p--->", "gi"), "</p>");
    htmlText = htmlText.replace(new RegExp("<P>", "gi"), "<p>");
    htmlText = htmlText.replace(new RegExp("</b>", "gi"), "<---/b--->");
    var c = "<s*/?s*b s*.*?>";
    htmlText = htmlText.replace(new RegExp(c, "gi"), "<b>");
    htmlText = htmlText.replace(new RegExp("<---/b--->", "gi"), "</b>");
    htmlText = htmlText.replace(new RegExp("<B>", "gi"), "<b>");
    htmlText = htmlText.replace(new RegExp("</i>", "gi"), "<---/i--->");
    var c = "<s*/?s*I s*.*?>";
    htmlText = htmlText.replace(new RegExp(c, "gi"), "<i>");
    htmlText = htmlText.replace(new RegExp("<---/i--->", "gi"), "</i>");
    htmlText = htmlText.replace(new RegExp("<I>", "gi"), "<i>");
    htmlText = htmlText.replace(new RegExp("</ul>", "gi"), "<---/ul--->");
    var d = "<s*/?s*UL s*.*?>";
    htmlText = htmlText.replace(new RegExp(d, "gi"), "<ul>");
    htmlText = htmlText.replace(new RegExp("<---/ul--->", "gi"), "</ul>");
    htmlText = htmlText.replace(new RegExp("<UL>", "gi"), "<ul>");
    htmlText = htmlText.replace(new RegExp("<OL", "gi"), "<ol");
    htmlText = htmlText.replace(new RegExp("</OL>", "gi"), "</ol>");
    htmlText = htmlText.replace(new RegExp("</li>", "gi"), "<---/li--->");
    var e = "<s*/?s*LI s*.*?>";
    htmlText = htmlText.replace(new RegExp(e, "gi"), "<li>");
    htmlText = htmlText.replace(new RegExp("<---/li--->", "gi"), "</li>");
    htmlText = htmlText.replace(new RegExp("<LI>", "gi"), "<li>");
    htmlText = htmlText.replace(new RegExp('border="0"', "gi"), 'border="1"');
    htmlText = htmlText.replace(new RegExp("border=0", "gi"), 'border="1"')
}

function encodeString() {
    htmlText = htmlText.replace(new RegExp("¢", "gi"), "&amp;cent;");
    htmlText = htmlText.replace(new RegExp("£", "gi"), "&amp;pound;");
    htmlText = htmlText.replace(new RegExp("¥", "gi"), "&amp;yen;");
    htmlText = htmlText.replace(new RegExp("€", "gi"), "&amp;euro;");
    htmlText = htmlText.replace(new RegExp("©", "gi"), "&amp;copy;");
    htmlText = htmlText.replace(new RegExp("®", "gi"), "&amp;reg;");
    htmlText = htmlText.replace(new RegExp("™", "gi"), "&amp;&trade;");
}