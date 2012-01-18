<?php
if (!defined ("TYPO3_MODE")) die ("Access denied.");

// here we register "tx_besecurepw_secure"
// for editing per tca form
$TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_besecurepw_secure'] = 'EXT:be_secure_pw/lib/class.tx_besecurepw_secure.php';

// for editing per "user settings"
if (t3lib_div::int_from_ver(TYPO3_version) >= 4002000 and t3lib_div::int_from_ver(TYPO3_version) < 4003000) {
	$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/setup/mod/index.php'] = PATH_typo3conf.'ext/be_secure_pw/v4.2/class.ux_SC_mod_user_setup_index.php';
} elseif (t3lib_div::int_from_ver(TYPO3_version) >= 4003000 and t3lib_div::int_from_ver(TYPO3_version) < 4004000) {
	$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/setup/mod/index.php'] = PATH_typo3conf.'ext/be_secure_pw/v4.3/class.ux_SC_mod_user_setup_index.php';
} elseif (t3lib_div::int_from_ver(TYPO3_version) >= 4004000 and t3lib_div::int_from_ver(TYPO3_version) < 4005000) {
	$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/setup/mod/index.php'] = PATH_typo3conf.'ext/be_secure_pw/v4.4/class.ux_SC_mod_user_setup_index.php';
}

if (t3lib_div::int_from_ver(TYPO3_version) >= 4005000) {
	$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/template.php']['preStartPageHook'][] = 'EXT:be_secure_pw/hook/class.user_usersetup_hook.php:&user_usersetup_hook->preStartPageHook';
	$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/template.php']['moduleBodyPostProcess'][] = 'EXT:be_secure_pw/hook/class.user_usersetup_hook.php:&user_usersetup_hook->moduleBodyPostProcess';

	// password reminder
	$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/backend.php']['constructPostProcess'][] = 'EXT:be_secure_pw/hook/class.user_backend_hook.php:&user_backend_hook->constructPostProcess';
	$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['be_secure_pw'] = 'EXT:be_secure_pw/hook/class.user_backend_hook.php:&user_backend_hook';
}

?>
