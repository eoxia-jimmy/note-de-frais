<?php
/**
 * Classe gérant les groupe NDF
 *
 * @author eoxia
 * @since 1.0.0.0
 * @version 1.0.0.0
 * @copyright 2017 Eoxia
 * @package group-ndf
 * @subpackage class
 */

namespace note_de_frais;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Classe gérant les groupe NDF
 */
class Group_NDF_Class extends \eoxia\Post_Class {

	/**
	 * Le nom du modèle
	 *
	 * @var string
	 */
	protected $model_name   				= '\note_de_frais\Group_NDF_Model';

	/**
	 * Le post type
	 *
	 * @var string
	 */
	protected $post_type    				= 'group-ndf';

	/**
	 * La clé principale du modèle
	 *
	 * @var string
	 */
	protected $meta_key    					= '_group_ndf';

	/**
	 * La fonction appelée automatiquement avant la création de l'objet dans la base de donnée
	 *
	 * @var array
	 */
	protected $before_post_function = array();

	/**
	 * La fonction appelée automatiquement avant la modification de l'objet dans la base de donnée
	 *
	 * @var array
	 */
	protected $before_put_function = array();

	/**
	 * La fonction appelée automatiquement après la récupération de l'objet dans la base de donnée
	 *
	 * @var array
	 */
	protected $after_get_function = array( '\note_de_frais\get_full_group' );

	/**
	 * Le nom pour le resgister post type
	 *
	 * @var string
	 */
	protected $post_type_name = 'Groupe NDF';

	/**
	 * Récupères les groupes NDF et les envoies à la vue principale.
	 *
	 * @return void
	 *
	 * @since 1.0.0.0
	 * @version 1.0.0.0
	 */
	public function display() {
		$groups_ndf = $this->get();

		\eoxia\View_Util::exec( 'note-de-frais', 'group-ndf', 'main', array(
			'groups_ndf' => $groups_ndf,
		) );
	}
}

Group_NDF_Class::g();
