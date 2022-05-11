<?php
namespace PHPMaker2019\SsmPT;

/**
 * Page class
 */
class footerkiri_add extends footerkiri
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{65C86988-D9B3-45F3-BFE9-EBEAEDC157CE}";

	// Table name
	public $TableName = 'footerkiri';

	// Page object name
	public $PageObjName = "footerkiri_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (footerkiri)
		if (!isset($GLOBALS["footerkiri"]) || get_class($GLOBALS["footerkiri"]) == PROJECT_NAMESPACE . "footerkiri") {
			$GLOBALS["footerkiri"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["footerkiri"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'footerkiri');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $footerkiri;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($footerkiri);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "footerkiriview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['Id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->Id->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("footerkirilist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->Id->Visible = FALSE;
		$this->Judul->setVisibility();
		$this->Isi->setVisibility();
		$this->Isi2->setVisibility();
		$this->Phone->setVisibility();
		$this->_Email->setVisibility();
		$this->Twitter->setVisibility();
		$this->Facebook->setVisibility();
		$this->Instagram->setVisibility();
		$this->LinkedIn->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("Id") !== NULL) {
				$this->Id->setQueryStringValue(Get("Id"));
				$this->setKey("Id", $this->Id->CurrentValue); // Set up key
			} else {
				$this->setKey("Id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("footerkirilist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "footerkirilist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "footerkiriview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->Id->CurrentValue = NULL;
		$this->Id->OldValue = $this->Id->CurrentValue;
		$this->Judul->CurrentValue = NULL;
		$this->Judul->OldValue = $this->Judul->CurrentValue;
		$this->Isi->CurrentValue = NULL;
		$this->Isi->OldValue = $this->Isi->CurrentValue;
		$this->Isi2->CurrentValue = NULL;
		$this->Isi2->OldValue = $this->Isi2->CurrentValue;
		$this->Phone->CurrentValue = NULL;
		$this->Phone->OldValue = $this->Phone->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->Twitter->CurrentValue = NULL;
		$this->Twitter->OldValue = $this->Twitter->CurrentValue;
		$this->Facebook->CurrentValue = NULL;
		$this->Facebook->OldValue = $this->Facebook->CurrentValue;
		$this->Instagram->CurrentValue = NULL;
		$this->Instagram->OldValue = $this->Instagram->CurrentValue;
		$this->LinkedIn->CurrentValue = NULL;
		$this->LinkedIn->OldValue = $this->LinkedIn->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'Judul' first before field var 'x_Judul'
		$val = $CurrentForm->hasValue("Judul") ? $CurrentForm->getValue("Judul") : $CurrentForm->getValue("x_Judul");
		if (!$this->Judul->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Judul->Visible = FALSE; // Disable update for API request
			else
				$this->Judul->setFormValue($val);
		}

		// Check field name 'Isi' first before field var 'x_Isi'
		$val = $CurrentForm->hasValue("Isi") ? $CurrentForm->getValue("Isi") : $CurrentForm->getValue("x_Isi");
		if (!$this->Isi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Isi->Visible = FALSE; // Disable update for API request
			else
				$this->Isi->setFormValue($val);
		}

		// Check field name 'Isi2' first before field var 'x_Isi2'
		$val = $CurrentForm->hasValue("Isi2") ? $CurrentForm->getValue("Isi2") : $CurrentForm->getValue("x_Isi2");
		if (!$this->Isi2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Isi2->Visible = FALSE; // Disable update for API request
			else
				$this->Isi2->setFormValue($val);
		}

		// Check field name 'Phone' first before field var 'x_Phone'
		$val = $CurrentForm->hasValue("Phone") ? $CurrentForm->getValue("Phone") : $CurrentForm->getValue("x_Phone");
		if (!$this->Phone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Phone->Visible = FALSE; // Disable update for API request
			else
				$this->Phone->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'Twitter' first before field var 'x_Twitter'
		$val = $CurrentForm->hasValue("Twitter") ? $CurrentForm->getValue("Twitter") : $CurrentForm->getValue("x_Twitter");
		if (!$this->Twitter->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Twitter->Visible = FALSE; // Disable update for API request
			else
				$this->Twitter->setFormValue($val);
		}

		// Check field name 'Facebook' first before field var 'x_Facebook'
		$val = $CurrentForm->hasValue("Facebook") ? $CurrentForm->getValue("Facebook") : $CurrentForm->getValue("x_Facebook");
		if (!$this->Facebook->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Facebook->Visible = FALSE; // Disable update for API request
			else
				$this->Facebook->setFormValue($val);
		}

		// Check field name 'Instagram' first before field var 'x_Instagram'
		$val = $CurrentForm->hasValue("Instagram") ? $CurrentForm->getValue("Instagram") : $CurrentForm->getValue("x_Instagram");
		if (!$this->Instagram->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Instagram->Visible = FALSE; // Disable update for API request
			else
				$this->Instagram->setFormValue($val);
		}

		// Check field name 'LinkedIn' first before field var 'x_LinkedIn'
		$val = $CurrentForm->hasValue("LinkedIn") ? $CurrentForm->getValue("LinkedIn") : $CurrentForm->getValue("x_LinkedIn");
		if (!$this->LinkedIn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LinkedIn->Visible = FALSE; // Disable update for API request
			else
				$this->LinkedIn->setFormValue($val);
		}

		// Check field name 'Id' first before field var 'x_Id'
		$val = $CurrentForm->hasValue("Id") ? $CurrentForm->getValue("Id") : $CurrentForm->getValue("x_Id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Judul->CurrentValue = $this->Judul->FormValue;
		$this->Isi->CurrentValue = $this->Isi->FormValue;
		$this->Isi2->CurrentValue = $this->Isi2->FormValue;
		$this->Phone->CurrentValue = $this->Phone->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Twitter->CurrentValue = $this->Twitter->FormValue;
		$this->Facebook->CurrentValue = $this->Facebook->FormValue;
		$this->Instagram->CurrentValue = $this->Instagram->FormValue;
		$this->LinkedIn->CurrentValue = $this->LinkedIn->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->Id->setDbValue($row['Id']);
		$this->Judul->setDbValue($row['Judul']);
		$this->Isi->setDbValue($row['Isi']);
		$this->Isi2->setDbValue($row['Isi2']);
		$this->Phone->setDbValue($row['Phone']);
		$this->_Email->setDbValue($row['Email']);
		$this->Twitter->setDbValue($row['Twitter']);
		$this->Facebook->setDbValue($row['Facebook']);
		$this->Instagram->setDbValue($row['Instagram']);
		$this->LinkedIn->setDbValue($row['LinkedIn']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['Id'] = $this->Id->CurrentValue;
		$row['Judul'] = $this->Judul->CurrentValue;
		$row['Isi'] = $this->Isi->CurrentValue;
		$row['Isi2'] = $this->Isi2->CurrentValue;
		$row['Phone'] = $this->Phone->CurrentValue;
		$row['Email'] = $this->_Email->CurrentValue;
		$row['Twitter'] = $this->Twitter->CurrentValue;
		$row['Facebook'] = $this->Facebook->CurrentValue;
		$row['Instagram'] = $this->Instagram->CurrentValue;
		$row['LinkedIn'] = $this->LinkedIn->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("Id")) <> "")
			$this->Id->CurrentValue = $this->getKey("Id"); // Id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// Id
		// Judul
		// Isi
		// Isi2
		// Phone
		// Email
		// Twitter
		// Facebook
		// Instagram
		// LinkedIn

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// Id
			$this->Id->ViewValue = $this->Id->CurrentValue;
			$this->Id->ViewCustomAttributes = "";

			// Judul
			$this->Judul->ViewValue = $this->Judul->CurrentValue;
			$this->Judul->ViewCustomAttributes = "";

			// Isi
			$this->Isi->ViewValue = $this->Isi->CurrentValue;
			$this->Isi->ViewCustomAttributes = "";

			// Isi2
			$this->Isi2->ViewValue = $this->Isi2->CurrentValue;
			$this->Isi2->ViewCustomAttributes = "";

			// Phone
			$this->Phone->ViewValue = $this->Phone->CurrentValue;
			$this->Phone->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Twitter
			$this->Twitter->ViewValue = $this->Twitter->CurrentValue;
			$this->Twitter->ViewCustomAttributes = "";

			// Facebook
			$this->Facebook->ViewValue = $this->Facebook->CurrentValue;
			$this->Facebook->ViewCustomAttributes = "";

			// Instagram
			$this->Instagram->ViewValue = $this->Instagram->CurrentValue;
			$this->Instagram->ViewCustomAttributes = "";

			// LinkedIn
			$this->LinkedIn->ViewValue = $this->LinkedIn->CurrentValue;
			$this->LinkedIn->ViewCustomAttributes = "";

			// Judul
			$this->Judul->LinkCustomAttributes = "";
			$this->Judul->HrefValue = "";
			$this->Judul->TooltipValue = "";

			// Isi
			$this->Isi->LinkCustomAttributes = "";
			$this->Isi->HrefValue = "";
			$this->Isi->TooltipValue = "";

			// Isi2
			$this->Isi2->LinkCustomAttributes = "";
			$this->Isi2->HrefValue = "";
			$this->Isi2->TooltipValue = "";

			// Phone
			$this->Phone->LinkCustomAttributes = "";
			$this->Phone->HrefValue = "";
			$this->Phone->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Twitter
			$this->Twitter->LinkCustomAttributes = "";
			$this->Twitter->HrefValue = "";
			$this->Twitter->TooltipValue = "";

			// Facebook
			$this->Facebook->LinkCustomAttributes = "";
			$this->Facebook->HrefValue = "";
			$this->Facebook->TooltipValue = "";

			// Instagram
			$this->Instagram->LinkCustomAttributes = "";
			$this->Instagram->HrefValue = "";
			$this->Instagram->TooltipValue = "";

			// LinkedIn
			$this->LinkedIn->LinkCustomAttributes = "";
			$this->LinkedIn->HrefValue = "";
			$this->LinkedIn->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Judul
			$this->Judul->EditAttrs["class"] = "form-control";
			$this->Judul->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Judul->CurrentValue = HtmlDecode($this->Judul->CurrentValue);
			$this->Judul->EditValue = HtmlEncode($this->Judul->CurrentValue);
			$this->Judul->PlaceHolder = RemoveHtml($this->Judul->caption());

			// Isi
			$this->Isi->EditAttrs["class"] = "form-control";
			$this->Isi->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Isi->CurrentValue = HtmlDecode($this->Isi->CurrentValue);
			$this->Isi->EditValue = HtmlEncode($this->Isi->CurrentValue);
			$this->Isi->PlaceHolder = RemoveHtml($this->Isi->caption());

			// Isi2
			$this->Isi2->EditAttrs["class"] = "form-control";
			$this->Isi2->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Isi2->CurrentValue = HtmlDecode($this->Isi2->CurrentValue);
			$this->Isi2->EditValue = HtmlEncode($this->Isi2->CurrentValue);
			$this->Isi2->PlaceHolder = RemoveHtml($this->Isi2->caption());

			// Phone
			$this->Phone->EditAttrs["class"] = "form-control";
			$this->Phone->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Phone->CurrentValue = HtmlDecode($this->Phone->CurrentValue);
			$this->Phone->EditValue = HtmlEncode($this->Phone->CurrentValue);
			$this->Phone->PlaceHolder = RemoveHtml($this->Phone->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// Twitter
			$this->Twitter->EditAttrs["class"] = "form-control";
			$this->Twitter->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Twitter->CurrentValue = HtmlDecode($this->Twitter->CurrentValue);
			$this->Twitter->EditValue = HtmlEncode($this->Twitter->CurrentValue);
			$this->Twitter->PlaceHolder = RemoveHtml($this->Twitter->caption());

			// Facebook
			$this->Facebook->EditAttrs["class"] = "form-control";
			$this->Facebook->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Facebook->CurrentValue = HtmlDecode($this->Facebook->CurrentValue);
			$this->Facebook->EditValue = HtmlEncode($this->Facebook->CurrentValue);
			$this->Facebook->PlaceHolder = RemoveHtml($this->Facebook->caption());

			// Instagram
			$this->Instagram->EditAttrs["class"] = "form-control";
			$this->Instagram->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Instagram->CurrentValue = HtmlDecode($this->Instagram->CurrentValue);
			$this->Instagram->EditValue = HtmlEncode($this->Instagram->CurrentValue);
			$this->Instagram->PlaceHolder = RemoveHtml($this->Instagram->caption());

			// LinkedIn
			$this->LinkedIn->EditAttrs["class"] = "form-control";
			$this->LinkedIn->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->LinkedIn->CurrentValue = HtmlDecode($this->LinkedIn->CurrentValue);
			$this->LinkedIn->EditValue = HtmlEncode($this->LinkedIn->CurrentValue);
			$this->LinkedIn->PlaceHolder = RemoveHtml($this->LinkedIn->caption());

			// Add refer script
			// Judul

			$this->Judul->LinkCustomAttributes = "";
			$this->Judul->HrefValue = "";

			// Isi
			$this->Isi->LinkCustomAttributes = "";
			$this->Isi->HrefValue = "";

			// Isi2
			$this->Isi2->LinkCustomAttributes = "";
			$this->Isi2->HrefValue = "";

			// Phone
			$this->Phone->LinkCustomAttributes = "";
			$this->Phone->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// Twitter
			$this->Twitter->LinkCustomAttributes = "";
			$this->Twitter->HrefValue = "";

			// Facebook
			$this->Facebook->LinkCustomAttributes = "";
			$this->Facebook->HrefValue = "";

			// Instagram
			$this->Instagram->LinkCustomAttributes = "";
			$this->Instagram->HrefValue = "";

			// LinkedIn
			$this->LinkedIn->LinkCustomAttributes = "";
			$this->LinkedIn->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->Id->Required) {
			if (!$this->Id->IsDetailKey && $this->Id->FormValue != NULL && $this->Id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Id->caption(), $this->Id->RequiredErrorMessage));
			}
		}
		if ($this->Judul->Required) {
			if (!$this->Judul->IsDetailKey && $this->Judul->FormValue != NULL && $this->Judul->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Judul->caption(), $this->Judul->RequiredErrorMessage));
			}
		}
		if ($this->Isi->Required) {
			if (!$this->Isi->IsDetailKey && $this->Isi->FormValue != NULL && $this->Isi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Isi->caption(), $this->Isi->RequiredErrorMessage));
			}
		}
		if ($this->Isi2->Required) {
			if (!$this->Isi2->IsDetailKey && $this->Isi2->FormValue != NULL && $this->Isi2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Isi2->caption(), $this->Isi2->RequiredErrorMessage));
			}
		}
		if ($this->Phone->Required) {
			if (!$this->Phone->IsDetailKey && $this->Phone->FormValue != NULL && $this->Phone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Phone->caption(), $this->Phone->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if ($this->Twitter->Required) {
			if (!$this->Twitter->IsDetailKey && $this->Twitter->FormValue != NULL && $this->Twitter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Twitter->caption(), $this->Twitter->RequiredErrorMessage));
			}
		}
		if ($this->Facebook->Required) {
			if (!$this->Facebook->IsDetailKey && $this->Facebook->FormValue != NULL && $this->Facebook->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Facebook->caption(), $this->Facebook->RequiredErrorMessage));
			}
		}
		if ($this->Instagram->Required) {
			if (!$this->Instagram->IsDetailKey && $this->Instagram->FormValue != NULL && $this->Instagram->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Instagram->caption(), $this->Instagram->RequiredErrorMessage));
			}
		}
		if ($this->LinkedIn->Required) {
			if (!$this->LinkedIn->IsDetailKey && $this->LinkedIn->FormValue != NULL && $this->LinkedIn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LinkedIn->caption(), $this->LinkedIn->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// Judul
		$this->Judul->setDbValueDef($rsnew, $this->Judul->CurrentValue, "", FALSE);

		// Isi
		$this->Isi->setDbValueDef($rsnew, $this->Isi->CurrentValue, "", FALSE);

		// Isi2
		$this->Isi2->setDbValueDef($rsnew, $this->Isi2->CurrentValue, "", FALSE);

		// Phone
		$this->Phone->setDbValueDef($rsnew, $this->Phone->CurrentValue, "", FALSE);

		// Email
		$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, "", FALSE);

		// Twitter
		$this->Twitter->setDbValueDef($rsnew, $this->Twitter->CurrentValue, NULL, FALSE);

		// Facebook
		$this->Facebook->setDbValueDef($rsnew, $this->Facebook->CurrentValue, NULL, FALSE);

		// Instagram
		$this->Instagram->setDbValueDef($rsnew, $this->Instagram->CurrentValue, NULL, FALSE);

		// LinkedIn
		$this->LinkedIn->setDbValueDef($rsnew, $this->LinkedIn->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("footerkirilist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>