<cfsetting enablecfoutputonly="Yes">
<!---
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2009 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.php
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.php
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.php
 *
 * == END LICENSE ==
 *
 * This is the "File Uploader" for ColdFusion (all versions).
 *
--->

<cfset REQUEST.CFVersion = Left( SERVER.COLDFUSION.PRODUCTVERSION, Find( ",", SERVER.COLDFUSION.PRODUCTVERSION ) - 1 )>
<cfif REQUEST.CFVersion lte 5>
	<cfinclude template="cf5_upload.cfm">
<cfelse>
	<cfinclude template="cf_upload.cfm">
</cfif>
