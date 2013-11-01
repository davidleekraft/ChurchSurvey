<?php
/**
 * User model
 * Linked to Users in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *
 */
class User extends AppModel {
	public $name = 'User';
	public $useTable = 'Users';
	public $displayField = 'UserType';
	public $primaryKey = 'UserID';
}