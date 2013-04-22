<?php
/**
 * CakePHP StarRating Helper
 * Makes use of FyneWorks' Jquery Star Rating Plugin - https://github.com/Fyneworks-jQuery/star-rating
 * API Documentation: http://www.fyneworks.com/jquery/star-rating/
 * Documentation and usage in README file
 * 
 * @author      Angel S. Moreno - angelxmoreno
 * @since       CakePHP StarRating Helper Ver. 1.0
 * @link        https://github.com/angelxmoreno/CakePHP-jQuery-Star-Helper
 * @package     Helper
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 * 
 * @property HtmlHelper $Html
 * @property FormHelper $Form
 */
App::uses('AppHelper', 'View/Helper');
class StarRatingHelper extends AppHelper {
        /**
         * List of helpers used by this helper
         *
         * @var array
         */
        public $helpers = array('Html', 'Form');
        
        function __construct(\View $View, $settings = array()) {
                parent::__construct($View, $settings);
                $this->_addScripts();
        }

        /**
         * Renders the code needed to display stars
         * 
         * @param Integer $checked
         * @param Integer $num_stars
         * @param Booleon $name
         * @param Booleon $disabled
         * @param Integer $split
         * @return String
         */
        public function stars($checked = 3, $num_stars = 10, $name = null, $disabled = false, $split = 1) {
                $num_stars = $num_stars*$split;
                $range = range(1,$num_stars);
                $options = array_combine($range, $range);
                $checked = $checked*$split;
                $output = '';
                for($i = 1; $i <= $num_stars; $i++){
                        $parameters = array(
                            'class' => 'star',
                            'disabled' => $disabled,
                            'type' => 'radio',
                            'name' => 'data[Rating]['.$name.']',
                            'value' => $i
                        );
                        if($split != 1){
                                $parameters['class'] .= " {split:$split}";
                        }
                        if($checked == $i){
                                $parameters['checked'] = 'checked';
                        }
                        $output .= $this->Html->tag('input', null, $parameters);
                }
                return $output;
        }
        
        protected function _addScripts(){
                $this->Html->css('/jquery_star_rating/star-rating/jquery.rating', null, array('inline'=>false));
                $this->Html->script('/jquery_star_rating/star-rating/jquery.MetaData', array('inline'=>false));
                $this->Html->script('/jquery_star_rating/star-rating/jquery.rating.pack', array('inline'=>false));
                
        }

}