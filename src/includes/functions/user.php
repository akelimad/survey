<?php

function isAdmin() {
	return (isset($_SESSION['id_type_role']) && in_array($_SESSION['id_type_role'], ['0', '1']));
}
