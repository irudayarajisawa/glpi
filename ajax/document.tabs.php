<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2011 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Julien Dombre
// Purpose of file:
// ----------------------------------------------------------------------

define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");

header("Content-Type: text/html; charset=UTF-8");
header_nocache();

if (!isset($_POST["id"])) {
   exit();
}
if (!isset($_REQUEST['glpi_tab'])) {
   exit();
}

$doc = new Document();

if ($_POST["id"]>0 && $doc->can($_POST["id"],'r')) {

   switch ($_REQUEST['glpi_tab']) {
      case -1 :
         $doc->showItems();
         Document::showAssociated($doc);
         Plugin::displayAction($doc, $_REQUEST['glpi_tab']);
         break;

      case 5 :
         Document::showAssociated($doc);
         break;

      case 10 :
         showNotesForm( $_POST['target'], 'Document', $_POST["id"]);
         break;

      case 12 :
         Log::showForItem($doc);
         break;

      default :
         if (!Plugin::displayAction($doc, $_REQUEST['glpi_tab'])) {
            $doc->showItems();
         }
   }
}
ajaxFooter();

?>
