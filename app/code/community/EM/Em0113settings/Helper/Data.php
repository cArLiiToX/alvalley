<?php
/**
 * @methods:
 * - get[Section]_[ConfigName]($defaultValue = '')
 */
class EM_Em0113settings_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function __call($name, $args) {
		if (method_exists($this, $name))
			call_user_func_array(array($this, $name), $args);
			
		elseif (preg_match('/^get([^_][a-zA-Z0-9_]+)$/', $name, $m)) {
			$segs = explode('_', $m[1]);
			foreach ($segs as $i => $seg)
				$segs[$i] = strtolower(preg_replace('/([^A-Z])([A-Z])/', '$1_$2', $seg));

			$value = Mage::getStoreConfig('em0113/'.implode('/', $segs));
			if (!$value) $value = @$args[0];
			return $value;
		}
		
		else 
			call_user_func_array(array($this, $name), $args);
	}
	
	public function getAllCssConfig() {
		$page_bgimage = Mage::getStoreConfig('em0113/general/page_bgfile') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0113/general/page_bgfile') . ')'
			: (Mage::getStoreConfig('em0113/general/page_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0113/general/page_bgimage').')' : '');
        $header_bgimage = Mage::getStoreConfig('em0113/typography/header_bgfile') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0113/typography/header_bgfile') . ')'
			: (Mage::getStoreConfig('em0113/typography/header_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0113/typography/header_bgimage').')' : '');
		$body_bgimage = Mage::getStoreConfig('em0113/typography/body_bgfile') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0113/typography/body_bgfile') . ')'
			: (Mage::getStoreConfig('em0113/typography/body_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0113/typography/body_bgimage').')' : '');
		$footer_bgimage = Mage::getStoreConfig('em0113/typography/footer_bgfile') ? 
			'url(' . Mage::getBaseUrl('media') . 'background/' . Mage::getStoreConfig('em0113/typography/footer_bgfile') . ')'
			: (Mage::getStoreConfig('em0113/typography/footer_bgimage') ? 'url(../images/stripes/'.Mage::getStoreConfig('em0113/typography/footer_bgimage').')' : '');
			
		return array(
			'page_bgcolor' => Mage::getStoreConfig('em0113/general/page_bgcolor'),
            'page_bgimage' => $page_bgimage,
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
			'header_bgimage' => $header_bgimage,
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
			'body_bgimage' => $body_bgimage,
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

			'footer_bgcolor' => Mage::getStoreConfig('em0113/typography/footer_bgcolor'),
            'footer_bgcolor2' => Mage::getStoreConfig('em0113/typography/footer_bgcolor2'),
			'footer_bgposition' => Mage::getStoreConfig('em0113/typography/footer_bgposition'),
			'footer_bgrepeat' => Mage::getStoreConfig('em0113/typography/footer_bgrepeat'),
			'footer_text_color1' => Mage::getStoreConfig('em0113/typography/footer_text_color1'),
			'footer_text_color2' => Mage::getStoreConfig('em0113/typography/footer_text_color2'),
			'footer_bgimage' => $footer_bgimage,
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
			

			'additional_css_file' => Mage::getStoreConfig('em0113/typography/additional_css_file'),
		);
	}
	
	public function getImageBackgroundColor() {
		$color = Mage::getStoreConfig('em0113/general/image_bgcolor');
		if (!$color) $color = '#ffffff';
		$color = str_replace('#', '', $color);
		if (strlen ($color )==6){
			return array(
				hexdec(substr($color, 0, 2)),
				hexdec(substr($color, 2, 2)),
				hexdec(substr($color, 4, 2))
		);
		}else{
			$color = str_replace('rgba(', '', $color);	
			$color = str_replace(')', '', $color);	
			$arr = explode(",", $color);
			return array(intval($arr[0]),intval($arr[1]),intval($arr[2]));
		}
	}
	
    public function getCategoriesCustom($parent,$curId){			
		$result = '';
		if($parent->getLevel() == 1)
			$result = "<option value='0'>".$this->getCatNameCustom($parent)."</option>";
		else{
			$result = "<option value='".$parent->getId()."' ";
			
			if($curId){
				if($curId	==	$parent->getId()) $result .= " selected='selected'";
			}
			$result .= ">".$this->getCatNameCustom($parent)."</option>";			
		}
		
		try{
			$children = $parent->getChildrenCategories();
			
			if(count($children) > 0){
				foreach($children as $cat){
					$result .= $this->getCategoriesCustom($cat,$curId);
				}
			}
		}
		catch(Exception $e){
			return '';
		}
		return $result;
	}

	public function getSubCategory($parent,$curId){
				
		try{
			$children = $parent->getChildrenCategories();
						
		}
		catch(Exception $e){
			return '';
		}
		return $children;
	}
	public function insertStaticBlock($dataBlock) {
		// insert a block to db if not exists
		$block = Mage::getModel('cms/block')->getCollection()->addFieldToFilter('identifier', $dataBlock['identifier'])->getFirstItem();
		if (!$block->getId())
			$block->setData($dataBlock)->save();
		return $block;
	}
	
	public function insertPage($dataPage) {
		$page = Mage::getModel('cms/page')->getCollection()->addFieldToFilter('identifier', $dataPage['identifier'])->getFirstItem();
		if (!$page->getId())
			$page->setData($dataPage)->save();
		return $page;
	}
    
    // For search by category
    public function getCategoriesCustomSearch($parent,$curId){
		$result = '';
		if($parent->getLevel() == 1){
            $result = "<option value='0'>".$this->getCatNameCustom($parent)."</option>";
		}			
		else{
			$result = "<option value='".$parent->getId()."' ";
			
			if($curId){
				if($curId	==	$parent->getId()) $result .= " selected='selected'";
			}
			$result .= ">".$this->getCatNameCustom($parent)."</option>";			
		}
		
		try{
			$children = $parent->getChildrenCategories();
			
			if(count($children) > 0){
				foreach($children as $cat){
					$result .= $this->getCategoriesCustomSearch($cat,$curId);
				}
			}
		}
		catch(Exception $e){
			return '';
		}
        //var_dump($result);
		return $result;
	}
	
	public function getCatNameCustom($category){
		$level = $category->getLevel();
		$html = '';
		for($i = 0;$i < $level;$i++){
			$html .= '&mdash;&ndash;';
		}
		if($level == 1)	return $html.' '.$this->__("All Categories");
		else return $html.' '.$category->getName();
	}
	
    public function checkMobilePhp() {
		require_once(Mage::getBaseDir('lib') . DS . 'em/Mobile_Detect.php');
		$detect = new Mobile_Detect();
        $checkmobile = $detect->isMobile();
        $checktablet = $detect->isTablet();
        if($checkmobile){
            if($checktablet){
                return false;
            }else{
                return true;
            }
            
        }else{
            return false;
        }
	}
	
	public function isShowOfferPrice($productPrice){
		if(!Mage::registry('current_product'))
			return false;
		return Mage::registry('current_product')->getId() == $productPrice->getId();
	}
	
	public function getHomeUrl() {
        return array(
            "label" => $this->__('Home'),
            "title" => $this->__('Home Page'),
            "link" => Mage::getUrl('')
        );
    }

    public function getIsLoginCustomer(){
    	if (Mage::getSingleton('customer/session')->isLoggedIn()==0):
    		return 0;
    	endif;
    	return 1;
    }

	public function getActionReview(){
		$url = Mage::helper('core/url')->getCurrentUrl();
		$url_check = 'wishlist/index/configure';
		if(stripos($url,$url_check)){
			$id = Mage::registry('current_product')->getId();
			return Mage::getUrl('review/product/post/', array('id' => $id,'_secure' => true));
		} else {
			$url_check2 = 'checkout/cart/configure';
			if(stripos($url,$url_check2)){
				$id = Mage::getSingleton('catalog/session')->getLastViewedProductId();
				return Mage::getUrl('review/product/post/', array('id' => $id,'_secure' => true));
			}else{
				$productId = Mage::app()->getRequest()->getParam('id', false);
				return Mage::getUrl('review/product/post', array('id' => $productId,'_secure' => true));
			}
		}
	}
}
