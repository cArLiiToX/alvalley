<?php
/**
 * @deprecated use Mage::helper('em0113settings') instead
 * @methods:
 * - get[Section]_[ConfigName]($defaultValue = '')
 */
class EM_Em0113settings_Em0113settings
{
	static function __callStatic($name, $args) {
		if (method_exists(self, $name))
			call_user_func_array(array(self, $name), $args);
			
		elseif (preg_match('/^get([^_][a-zA-Z0-9_]+)$/', $name, $m)) {
			$segs = explode('_', $m[1]);
			foreach ($segs as $i => $seg)
				$segs[$i] = strtolower(preg_replace('/([^A-Z])([A-Z])/', '$1_$2', $seg));

			$value = Mage::getStoreConfig('em0113/'.implode('/', $segs));
			if (!$value) $value = @$args[0];
			return $value;
		}
		
		else 
			call_user_func_array(array(self, $name), $args);
	}

	
	/**
	 * @return array
	 */
	public static function getAllCssConfig() {
		return array(
			'page_bgcolor' => Mage::getStoreConfig('em0113/general/page_bgcolor'),
            'page_bgimage' => Mage::getStoreConfig('em0113/general/page_bgimage'),
            'page_bgposition' => Mage::getStoreConfig('em0113/general/page_bgposition'),
			'page_bgrepeat' => Mage::getStoreConfig('em0113/general/page_bgrepeat'),
		
			'general_font' => Mage::getStoreConfig('em0113/typography/general_font'),
			'h1_font' => Mage::getStoreConfig('em0113/typography/h1_font'),
			'h2_font' => Mage::getStoreConfig('em0113/typography/h2_font'),
			'h3_font' => Mage::getStoreConfig('em0113/typography/h3_font'),
			'h4_font' => Mage::getStoreConfig('em0113/typography/h4_font'),
			'h5_font' => Mage::getStoreConfig('em0113/typography/h5_font'),
            'h6_font' => Mage::getStoreConfig('em0113/typography/h6_font'),

            'box_shadow' => Mage::getStoreConfig('em0113/typography/box_shadow'),
			'rounded_corner' => Mage::getStoreConfig('em0113/typography/rounded_corner'),

			'header_bgcolor' => Mage::getStoreConfig('em0113/typography/header_bgcolor'),
            'header_bgcolor2' => Mage::getStoreConfig('em0113/typography/header_bgcolor2'),
			'header_bgposition' => Mage::getStoreConfig('em0113/typography/header_bgposition'),
			'header_bgrepeat' => Mage::getStoreConfig('em0113/typography/header_bgrepeat'),
			'header_text_color' => Mage::getStoreConfig('em0113/typography/header_text_color'),
            'header_text2_color' => Mage::getStoreConfig('em0113/typography/header_text2_color'),
            'header_text3_color' => Mage::getStoreConfig('em0113/typography/header_text3_color'),
            'header_text4_color' => Mage::getStoreConfig('em0113/typography/header_text4_color'),
            'header_text5_color' => Mage::getStoreConfig('em0113/typography/header_text5_color'),
			'header_bgimage' => Mage::getStoreConfig('em0113/typography/header_bgimage'),
            'header_line' => Mage::getStoreConfig('em0113/typography/header_line'),

			'menu_top_bgcolor' => Mage::getStoreConfig('em0113/typography/menu_top_bgcolor'),
			'menu_top_hover_bgcolor' => Mage::getStoreConfig('em0113/typography/menu_top_hover_bgcolor'),
			'menu_top_text_color' => Mage::getStoreConfig('em0113/typography/menu_top_text_color'),
			'menu_active_text_color' => Mage::getStoreConfig('em0113/typography/menu_active_text_color'),
			'menu_top_font' => Mage::getStoreConfig('em0113/typography/menu_top_font'),
			'menu_drop_bgcolor' => Mage::getStoreConfig('em0113/typography/menu_drop_bgcolor'),
			'menu_drop_hover_bgcolor' => Mage::getStoreConfig('em0113/typography/menu_drop_hover_bgcolor'),
			'menu_drop_text_color' => Mage::getStoreConfig('em0113/typography/menu_drop_text_color'),
            'menu_drop_text2_color' => Mage::getStoreConfig('em0113/typography/menu_drop_text2_color'),
            'menu_drop_text3_color' => Mage::getStoreConfig('em0113/typography/menu_drop_text3_color'),
			'menu_drop_font' => Mage::getStoreConfig('em0113/typography/menu_drop_font'),
            'menu_drop_line' => Mage::getStoreConfig('em0113/typography/menu_drop_line'),

			'body_bgcolor1' => Mage::getStoreConfig('em0113/typography/body_bgcolor1'),
			'body_bgcolor2' => Mage::getStoreConfig('em0113/typography/body_bgcolor2'),
			'body_bgcolor3' => Mage::getStoreConfig('em0113/typography/body_bgcolor3'),
            'body_bgcolor4' => Mage::getStoreConfig('em0113/typography/body_bgcolor4'),
            'body_bgcolor5' => Mage::getStoreConfig('em0113/typography/body_bgcolor5'),
			'body_bgposition' => Mage::getStoreConfig('em0113/typography/body_bgposition'),
			'body_bgrepeat' => Mage::getStoreConfig('em0113/typography/body_bgrepeat'),
			'body_bgimage' => Mage::getStoreConfig('em0113/typography/body_bgimage'),
			'body_text_color1' => Mage::getStoreConfig('em0113/typography/body_text_color1'),
			'body_text_color2' => Mage::getStoreConfig('em0113/typography/body_text_color2'),
			'body_text_color3' => Mage::getStoreConfig('em0113/typography/body_text_color3'),
			'body_text_color4' => Mage::getStoreConfig('em0113/typography/body_text_color4'),
            'body_text_color5' => Mage::getStoreConfig('em0113/typography/body_text_color5'),
            'body_text_color6' => Mage::getStoreConfig('em0113/typography/body_text_color6'),
            'body_text_color7' => Mage::getStoreConfig('em0113/typography/body_text_color7'),
			'body_link_color' => Mage::getStoreConfig('em0113/typography/body_link_color'),
			'body_line1' => Mage::getStoreConfig('em0113/typography/body_line1'),
			'body_line2' => Mage::getStoreConfig('em0113/typography/body_line2'),
			'body_line3' => Mage::getStoreConfig('em0113/typography/body_line3'),

			'footer_bgcolor1' => Mage::getStoreConfig('em0113/typography/footer_bgcolor1'),
            'footer_bgcolor2' => Mage::getStoreConfig('em0113/typography/footer_bgcolor2'),
			'footer_bgposition' => Mage::getStoreConfig('em0113/typography/footer_bgposition'),
			'footer_bgrepeat' => Mage::getStoreConfig('em0113/typography/footer_bgrepeat'),
			'footer_text_color1' => Mage::getStoreConfig('em0113/typography/footer_text_color1'),
			'footer_text_color2' => Mage::getStoreConfig('em0113/typography/footer_text_color2'),
			'footer_bgimage' => Mage::getStoreConfig('em0113/typography/footer_bgimage'),
			'footer_line1' => Mage::getStoreConfig('em0113/typography/footer_line1'),
			'footer_line2' => Mage::getStoreConfig('em0113/typography/footer_line2'),

			'button1_bgcolor' => Mage::getStoreConfig('em0113/typography/button1_bgcolor'),
			'button1_color' => Mage::getStoreConfig('em0113/typography/button1_color'),
			'button1_font' => Mage::getStoreConfig('em0113/typography/button1_font'),
			'button2_bgcolor' => Mage::getStoreConfig('em0113/typography/button2_bgcolor'),
			'button2_font' => Mage::getStoreConfig('em0113/typography/button2_font'),
			'button2_color' => Mage::getStoreConfig('em0113/typography/button2_color'),
            'button3_bgcolor' => Mage::getStoreConfig('em0113/typography/button3_bgcolor'),
			'button3_color' => Mage::getStoreConfig('em0113/typography/button3_color'),
			'button3_font' => Mage::getStoreConfig('em0113/typography/button3_font'),			
            'button4_bgcolor' => Mage::getStoreConfig('em0113/typography/button4_bgcolor'),
			'button4_color' => Mage::getStoreConfig('em0113/typography/button4_color'),
			'button4_font' => Mage::getStoreConfig('em0113/typography/button4_font'),
			
		);
	}   
}