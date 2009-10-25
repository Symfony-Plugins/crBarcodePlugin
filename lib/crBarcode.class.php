<?php

/**
 * crBarcode Plugin. Barcode Factory to create barcodes for:
 *  - Code128
 *  - Code 39
 *  - EAN 13
 *  - Interleaved 2 of 5
 *  - PostNET
 *  - UPC-A
 * This plugin uses PEAR Barcode library with adapted to current PHP 5.x requirements 
 * and symfony framework.
 *
 * @author Lic. Christian A. Rodriguez <car@cespi.unlp.edu.ar>
 */

require_once ('Image/Barcode.php');

class crBarcode 
{
  private $type;
  private $image_type;

  /* Returns an instance of Code 39 Barcode
   *
   * @param  string $imgtype  The image type that will be generated
   *
   * @access public
   */
  public static function getInstanceForCode39($image_type='png')
  {
    return new crBarcode('Code39',$image_type);
  }

  /* Returns an instance of Code 128 Barcode
   *
   * @param  string $imgtype  The image type that will be generated
   *
   * @access public
   */
  public static function getInstanceForCode128($image_type='png')
  {
    return new crBarcode('code128',$image_type);
  }

  /* Returns an instance of ean 13 Barcode
   *
   * @param  string $imgtype  The image type that will be generated
   *
   * @access public
   */
  public static function getInstanceForEan13($image_type='png')
  {
    return new crBarcode('ean13',$image_type);
  }

  /* Returns an instance of int 25 Barcode
   *
   * @param  string $imgtype  The image type that will be generated
   *
   * @access public
   */
  public static function getInstanceForInt25($image_type='png')
  {
    return new crBarcode('int25',$image_type);
  }

  /* Returns an instance of postnet Barcode
   *
   * @param  string $imgtype  The image type that will be generated
   *
   * @access public
   */
  public static function getInstanceForPostnet($image_type='png')
  {
    return new crBarcode('postnet',$image_type);
  }

  /* Returns an instance of UPC-A Barcode
   *
   * @param  string $imgtype  The image type that will be generated
   *
   * @access public
   */
  public static function getInstanceForUpca($image_type='png')
  {
    return new crBarcode('upca',$image_type);
  }

  /* crBarcode constructor. Never call this method directly
   *
   * @param  string $type     The barcode type. Supported types:
   *                          Code39 - Code 3 of 9
   *                          int25  - 2 Interleaved 5
   *                          ean13  - EAN 13
   *                          upca   - UPC-A
   * @param  string $imgtype  The image type that will be generated
   *
   * @access private
   */
  private function __construct($type,$image_type)
  {
    if (!function_exists('imagecreate'))
    {
      throw new LogicException('gd extension is required');
    }
    $this->type=$type;
    $this->image_type=$image_type;
  }

  /* Returns an image stream representing the specified text
   *
   * @param  string $text     text to represents as barcode image
   *
   * @access public
   *
   * @return image stream
   */
  public function getImage($text)
  {
    return Image_Barcode::getInstance($text, $this->type, $this->image_type, false);
  }
  
  /* Send an image stream representing the specified text as image to the browser
   *
   * @param  string $text     text to represents as barcode image
   *
   * @access public
   *
   * @return image stream
   */
  public function renderImage($text)
  {
    return Image_Barcode::getInstance($text, $this->type, $this->image_type, true);
  }
}
