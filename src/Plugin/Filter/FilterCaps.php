<?php
namespace Drupal\day8\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;
use Drupal\Core\Form\FormStateInterface;

/**
 * @Filter(
 *   id = "filter_caps",
 *   title = @Translation("Caps Filter"),
 *   description = @Translation("Help this text format caps custom words!"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * 
 )
 */

class FilterCaps extends FilterBase {
	public function process($text, $langcode) {
		$find= explode(',', $this->settings['filter_caps']);
		$find = array_map('trim', $find);	
		$replace= array_map('strtoupper', $find);	
    $new_text = str_replace($find, $replace, $text);
    return new FilterProcessResult($new_text);
	}
	public function settingsForm(array $form, FormStateInterface $form_state) {
		$form['filter_caps'] = array(
      '#type' => 'textfield',
			'#title' => $this->t('Words to change to uppercase'),
      '#default_value' => $this->settings['filter_caps'],
			'#description' => $this->t('Enter list of words which should be capitalised. Separate multiple words with comma.'),
		);
		return $form;
	}
}
