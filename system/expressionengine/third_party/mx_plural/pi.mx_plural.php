<?php

/**
 *  MX Plural Class for ExpressionEngine2
 *
 * @package		ExpressionEngine
 * @subpackage	Plugins
 * @category	Plugins
 * @author    Max Lazar <max@eec.ms>
 * @Commercial - please see LICENSE file included with this distribution. 
 */



$plugin_info = array(
    'pi_name' => 'MX Plural',
    'pi_version' => '1.0.1',
    'pi_author' => 'Max Lazar',
    'pi_author_url' => 'http://eec.ms/',
    'pi_description' => 'MX Plural allows you to choose correct plural form of words in different languages.',
    'pi_usage' => Mx_plural::usage()
);




Class Mx_plural
{
    var $return_data = "";
    var $var_name = "";
    
    
    function Mx_plural()
    {
	
        $this->EE =& get_instance();
        $lang_id = ( ! $this->EE->TMPL->fetch_param('lang_id')) ?  'en' : $this->EE->TMPL->fetch_param('lang_id');
		$lang_str =  ( ! $this->EE->TMPL->fetch_param('str')) ?  null : $this->EE->TMPL->fetch_param('str');
		$qty =  ( ! $this->EE->TMPL->fetch_param('qty')) ?  1 : $this->EE->TMPL->fetch_param('qty');
		
		$pattern =  ( ! $this->EE->TMPL->fetch_param('pattern')) ?  false : $this->EE->TMPL->fetch_param('pattern');
		
		
		return $this->return_data = (($pattern) ? str_replace (array("%d", "%w"), array($qty, $this->get_lang($lang_str,  $qty,  $lang_id)),$pattern) : $this->get_lang($lang_str, $qty,  $lang_id));
		
    }


	function get_lang($str, $n = null, $lang_id = null ) {
			
			$lang  = explode("|", $str);

			if ( null === $n ) {
					return '';
			}
	 
			$key_postfix = '';
	 
			switch ( $lang_id ) {
					case 'af': // Afrikaans, nplurals=2
							$s = ( ($n==1) ? 0 :  2);
							$localized = $lang[ $s ];
					break;		
						
					case 'ar': // arabic, nplurals=6
							$s = ( ($n== 0) ? 0 : ( ($n==1) ? 1 : ( ($n==2) ? 2 : ( ( ($n % 100 >= 3) && ($n % 100 <= 10) ) ? 3 : ( ( ($n % 100 >= 11) && ($n % 100 <= 99) ) ? 4 : 5 ) ) ) ) );
							$localized = $lang[ $s ];
					break;
	 
					case 'cz': // czech, nplurals=3
							$s = ( ($n==1) ? '0' : ($n>=2 && $n<=4) ? 1 : 1 );
							$localized = $lang[ $s ];
					break;

					case 'de': // german 
					case 'bg': // bulgarian
					case 'gr': // greek
					case 'en': // english 
					case 'es': // espanol
					case 'ee': // estonian
					case 'il': // hebrew
					case 'it': // italian
					case 'mn': // mongolian
					case 'nl': // dutch
					case 'sq': // albainian
					case 'my': // malay
							// nplurals=2;
							$s = ( ($n != 1) ? '0' : 1 );
							$localized = $lang[ $s ];
					break;

					case 'pl': // polskiy, nplurals=3
	 						$s = (($n == 1) ? 0 : (( ($n%10>=2) && ($n%10<=4) && ($n%100<10 || $n%100>=20) ) ? 1 : 2 ));
							$localized = $lang[ $s ];
					break;
	 
					case 'ru': // russian, nplurals=3
							$s = ( (($n%10==1) && ($n%100!=11)) ? '0' : (( ($n%10>=2) && ($n%10<=4) && ($n%100<10 || $n%100>=20)) ? 1 : 2 ) );
							$localized = $lang[ $s ];
					break;

					case 'sk': //    Slovak, nplurals=3
							$s = ( ($n==1) ? 1 : ( ($n>=2 && $n<=4) ? 1 : '0' ) );
							$localized = $lang[ $s ];
					break;
	 	 
					case 'fa': // farsi 
					case 'ja': // japan
					case 'tr': // turkish
					case 'vn': // vietnamese 
					case 'cn': // chinese +
					case 'tw': // tradional Chinese (?)
					case 'kz': // Kazakh
							// nplurals=1
							$s = '0';
							$localized = $lang[ $s ];
					break;
	 
					case 'ua': // ukrainian, nplurals=3
							$s = ( ($n%10==1 && $n%100!=11) ? '0' : ( $n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ) ? 1 : 1 );
							$localized = $lang[ $s ];
					break;
	 
					case 'lt': // Lithuanian, nplurals=3
							$s = ( ($n%10==1 && $n%100!=11) ? '0' : ( $n%10>=2 && ($n%100<10 || $n%100>=20) ) ? 1 : 1 );
							$localized = $lang[ $s ];
					break;
	 
					case 'fr': // french, nplurals=2
							$s = ( $n > 1 ? '0' : 1 );
							$localized = $lang[ $key.$s ];
					break;
					
					case 'ie ': // Irish, nplurals=5; 
							$s = (($n==1)? 0 : (($n==2) ? 1 : (($n<7) ? 2 : (($n<11) ? 3 : 4))));
							$localized = $lang[ $s ];
					break;		
					
					case 'is': // Icelandic, nplurals=2;

					case 'hr':  // Croatian , nplurals=3;
							$s = ($n%10!=1 || $n%100==11) ? 0 : 1;
							$localized = $lang[ $s ];
					break;		
					
					case 'lv': // Latvian 
							$s = ( ($n%10==1 && $n%100!=11) ? 0 : (($n != 0) ? 1 : 2)); 
							$localized = $lang[ $s ];
					break;
					
					case 'cy': // Welsh, 	nplurals=4 
							$s =  (($n==1) ? 0 : (($n==2) ? 1 : (($n != 8 && $n != 11) ? 2 : 3)));	
							$localized = $lang[ $s ];
					break;				
					
					case 'be': // Belarusian, 	nplurals=3

					case 'bs ': // Bosnian, 	nplurals=3
							$s =  (($n%10==1 && $n%100!=11) ? 0 : (($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20)) ? 1 : 2));	
							$localized = $lang[ $s ];
					break;				

			}
	 
			return $localized;
	}
		
    // ----------------------------------------
    //  Plugin Usage
    // ----------------------------------------
    
    // This function describes how the plugin is used.
    //  Make sure and use output buffering
    
    function usage()
    {
        ob_start();
?>

	  Languages Supported: 
	  Afrikaans(af) Albanian(sq) Arabic(ar) Belarusian(be) Bosnian(bs) Bulgarian(bz) Chinese(tw) Croatian(hr) Czech(cz) Dutch(nl) English(nl) Estonian(ee) Farsi(fa) French(fr) German(de) Greek(gr) Hebrew(il) Icelandic(is) Irish(ie) Italian(it) Japan(ja) Kazakh(kz) Latvian(lv) Lithuanian(lt) Malay(my) Mongolian(mn) Polskiy(pl) Russian(ru) Slovak(sk) Spanish(es) Turkish(tr) Ukrainian(ua) Vietnamese(vn) Welsh(cy)
	  
	  Parameters:
	  
	  lang_id(required) language ISO code
	  str(required) Words forms separated with |
	  qty(optional, defaul = 1) quantity
 	  pattern (optional) Output pattern %d - qty, %w - word.
	  
	  Examples:
	  {exp:mx_plural lang_id = "fr" qty = "1" str = "maison|maisons"}
	  output:  maison
	  {exp:mx_plural lang_id = "fr" qty = "5" str = "maison|maisons" pattern = "%d %w"}
	  output: 5 maisons
	  
	  {exp:mx_plural lang_id = "pl" qty = "5" str="dom|domy|domow" pattern = "%d %w" }
	  output: 5 domow 
	  {exp:mx_plural lang_id = "pl" qty = "1" str = "dom|domy|domow" pattern = "%d %w"}
	  output: 1 dom
	  {exp:mx_plural lang_id = "pl" qty = "24" str = "dom|domy|domow" pattern = "%d %w"}
	  output: 24 domy 



<?php
        $buffer = ob_get_contents();
        
        ob_end_clean();
        
        return $buffer;
    }
    /* END */
    
}

/* End of file pi.mx_plural.php */
/* Location: ./system/expressionengine/third_party/mx_plural/pi.mx_plural.php */