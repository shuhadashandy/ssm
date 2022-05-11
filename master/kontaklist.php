<?php
namespace PHPMaker2019\SsmPT;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$kontak_list = new kontak_list();

// Run the page
$kontak_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$kontak->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fkontaklist = currentForm = new ew.Form("fkontaklist", "list");
fkontaklist.formKeyCountName = '<?php echo $kontak_list->FormKeyCountName ?>';

// Form_CustomValidate event
fkontaklist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fkontaklist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fkontaklistsrch = currentSearchForm = new ew.Form("fkontaklistsrch");

// Filters
fkontaklistsrch.filterList = <?php echo $kontak_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$kontak->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kontak_list->TotalRecs > 0 && $kontak_list->ExportOptions->visible()) { ?>
<?php $kontak_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kontak_list->ImportOptions->visible()) { ?>
<?php $kontak_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kontak_list->SearchOptions->visible()) { ?>
<?php $kontak_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kontak_list->FilterOptions->visible()) { ?>
<?php $kontak_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kontak_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kontak->isExport() && !$kontak->CurrentAction) { ?>
<form name="fkontaklistsrch" id="fkontaklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($kontak_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fkontaklistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kontak">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($kontak_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($kontak_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kontak_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kontak_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $kontak_list->showPageHeader(); ?>
<?php
$kontak_list->showMessage();
?>
<?php if ($kontak_list->TotalRecs > 0 || $kontak->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kontak_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kontak">
<?php if (!$kontak->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kontak->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($kontak_list->Pager)) $kontak_list->Pager = new PrevNextPager($kontak_list->StartRec, $kontak_list->DisplayRecs, $kontak_list->TotalRecs, $kontak_list->AutoHidePager) ?>
<?php if ($kontak_list->Pager->RecordCount > 0 && $kontak_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($kontak_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($kontak_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $kontak_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($kontak_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($kontak_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $kontak_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($kontak_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $kontak_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $kontak_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $kontak_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kontak_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkontaklist" id="fkontaklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($kontak_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $kontak_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak">
<div id="gmp_kontak" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($kontak_list->TotalRecs > 0 || $kontak->isGridEdit()) { ?>
<table id="tbl_kontaklist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kontak_list->RowType = ROWTYPE_HEADER;

// Render list options
$kontak_list->renderListOptions();

// Render list options (header, left)
$kontak_list->ListOptions->render("header", "left");
?>
<?php if ($kontak->Nama->Visible) { // Nama ?>
	<?php if ($kontak->sortUrl($kontak->Nama) == "") { ?>
		<th data-name="Nama" class="<?php echo $kontak->Nama->headerCellClass() ?>"><div id="elh_kontak_Nama" class="kontak_Nama"><div class="ew-table-header-caption"><?php echo $kontak->Nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama" class="<?php echo $kontak->Nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $kontak->SortUrl($kontak->Nama) ?>',1);"><div id="elh_kontak_Nama" class="kontak_Nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak->Nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak->Nama->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($kontak->Nama->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak->_Email->Visible) { // Email ?>
	<?php if ($kontak->sortUrl($kontak->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $kontak->_Email->headerCellClass() ?>"><div id="elh_kontak__Email" class="kontak__Email"><div class="ew-table-header-caption"><?php echo $kontak->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $kontak->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $kontak->SortUrl($kontak->_Email) ?>',1);"><div id="elh_kontak__Email" class="kontak__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak->_Email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($kontak->_Email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak->Judul->Visible) { // Judul ?>
	<?php if ($kontak->sortUrl($kontak->Judul) == "") { ?>
		<th data-name="Judul" class="<?php echo $kontak->Judul->headerCellClass() ?>"><div id="elh_kontak_Judul" class="kontak_Judul"><div class="ew-table-header-caption"><?php echo $kontak->Judul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Judul" class="<?php echo $kontak->Judul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $kontak->SortUrl($kontak->Judul) ?>',1);"><div id="elh_kontak_Judul" class="kontak_Judul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak->Judul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak->Judul->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($kontak->Judul->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kontak->Status->Visible) { // Status ?>
	<?php if ($kontak->sortUrl($kontak->Status) == "") { ?>
		<th data-name="Status" class="<?php echo $kontak->Status->headerCellClass() ?>"><div id="elh_kontak_Status" class="kontak_Status"><div class="ew-table-header-caption"><?php echo $kontak->Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Status" class="<?php echo $kontak->Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $kontak->SortUrl($kontak->Status) ?>',1);"><div id="elh_kontak_Status" class="kontak_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kontak->Status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kontak->Status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($kontak->Status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kontak_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kontak->ExportAll && $kontak->isExport()) {
	$kontak_list->StopRec = $kontak_list->TotalRecs;
} else {

	// Set the last record to display
	if ($kontak_list->TotalRecs > $kontak_list->StartRec + $kontak_list->DisplayRecs - 1)
		$kontak_list->StopRec = $kontak_list->StartRec + $kontak_list->DisplayRecs - 1;
	else
		$kontak_list->StopRec = $kontak_list->TotalRecs;
}
$kontak_list->RecCnt = $kontak_list->StartRec - 1;
if ($kontak_list->Recordset && !$kontak_list->Recordset->EOF) {
	$kontak_list->Recordset->moveFirst();
	$selectLimit = $kontak_list->UseSelectLimit;
	if (!$selectLimit && $kontak_list->StartRec > 1)
		$kontak_list->Recordset->move($kontak_list->StartRec - 1);
} elseif (!$kontak->AllowAddDeleteRow && $kontak_list->StopRec == 0) {
	$kontak_list->StopRec = $kontak->GridAddRowCount;
}

// Initialize aggregate
$kontak->RowType = ROWTYPE_AGGREGATEINIT;
$kontak->resetAttributes();
$kontak_list->renderRow();
while ($kontak_list->RecCnt < $kontak_list->StopRec) {
	$kontak_list->RecCnt++;
	if ($kontak_list->RecCnt >= $kontak_list->StartRec) {
		$kontak_list->RowCnt++;

		// Set up key count
		$kontak_list->KeyCount = $kontak_list->RowIndex;

		// Init row class and style
		$kontak->resetAttributes();
		$kontak->CssClass = "";
		if ($kontak->isGridAdd()) {
		} else {
			$kontak_list->loadRowValues($kontak_list->Recordset); // Load row values
		}
		$kontak->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kontak->RowAttrs = array_merge($kontak->RowAttrs, array('data-rowindex'=>$kontak_list->RowCnt, 'id'=>'r' . $kontak_list->RowCnt . '_kontak', 'data-rowtype'=>$kontak->RowType));

		// Render row
		$kontak_list->renderRow();

		// Render list options
		$kontak_list->renderListOptions();
?>
	<tr<?php echo $kontak->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kontak_list->ListOptions->render("body", "left", $kontak_list->RowCnt);
?>
	<?php if ($kontak->Nama->Visible) { // Nama ?>
		<td data-name="Nama"<?php echo $kontak->Nama->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCnt ?>_kontak_Nama" class="kontak_Nama">
<span<?php echo $kontak->Nama->viewAttributes() ?>>
<?php echo $kontak->Nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak->_Email->Visible) { // Email ?>
		<td data-name="_Email"<?php echo $kontak->_Email->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCnt ?>_kontak__Email" class="kontak__Email">
<span<?php echo $kontak->_Email->viewAttributes() ?>>
<?php echo $kontak->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak->Judul->Visible) { // Judul ?>
		<td data-name="Judul"<?php echo $kontak->Judul->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCnt ?>_kontak_Judul" class="kontak_Judul">
<span<?php echo $kontak->Judul->viewAttributes() ?>>
<?php echo $kontak->Judul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kontak->Status->Visible) { // Status ?>
		<td data-name="Status"<?php echo $kontak->Status->cellAttributes() ?>>
<span id="el<?php echo $kontak_list->RowCnt ?>_kontak_Status" class="kontak_Status">
<span<?php echo $kontak->Status->viewAttributes() ?>>
<?php echo $kontak->Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kontak_list->ListOptions->render("body", "right", $kontak_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$kontak->isGridAdd())
		$kontak_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$kontak->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kontak_list->Recordset)
	$kontak_list->Recordset->Close();
?>
<?php if (!$kontak->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kontak->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($kontak_list->Pager)) $kontak_list->Pager = new PrevNextPager($kontak_list->StartRec, $kontak_list->DisplayRecs, $kontak_list->TotalRecs, $kontak_list->AutoHidePager) ?>
<?php if ($kontak_list->Pager->RecordCount > 0 && $kontak_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($kontak_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($kontak_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $kontak_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($kontak_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($kontak_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $kontak_list->pageUrl() ?>start=<?php echo $kontak_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $kontak_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($kontak_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $kontak_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $kontak_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $kontak_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kontak_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kontak_list->TotalRecs == 0 && !$kontak->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kontak_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kontak_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$kontak->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$kontak_list->terminate();
?>