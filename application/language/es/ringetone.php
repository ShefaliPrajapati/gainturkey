<?php
/***************************************************************************
@ You should      have received    a copy of the     GNU General    Public License.
@ along  with this    program; if not,  write to the  Free Software.
@
@ This  program is     distributed in   the hope that it   will be useful,
@ but     WITHOUT ANY   WARRANTY; without     even the implied     warranty of
@ MERCHANTABILITY      or FITNESS FOR  A PARTICULAR      PURPOSE.  See the
@ GNU      General Public      License for    more details.
@
@ This program is     free software;      you can redistribute     it and/or
@ modify it      under the terms of    the GNU General Public     License
@ as  published by the     Free Software   Foundation; either      version 2
@ of     the License,     or (at your option)    any later version.
***************************************************************************/

if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
    @error_reporting(E_ALL ^ (E_DEPRECATED|E_USER_DEPRECATED));
    @ini_set('error_reporting', E_ALL ^ (E_DEPRECATED|E_USER_DEPRECATED));
}
