<?php

namespace App\Utilities;

class ImageHelper
{
	public static $PUBLIC_IMG_16_9_PATH = null;
	public static $PUBLIC_IMG_4_3_PATH = null;
	public static $PUBLIC_IMG_PATH = null;

	const JPEG_REGEXP = '/.*\.jpeg/';
	const JPG_REGEXP = '/.*\.jpg/';
	const PNG_REGEXP = '/.*\.png/';

	private function __constructor()
	{
	}

	public static function init()
	{
		self::$PUBLIC_IMG_16_9_PATH = public_path('images/16_9');
		self::$PUBLIC_IMG_4_3_PATH = public_path('images/4_3');
		self::$PUBLIC_IMG_PATH = public_path('images');
	}

	private static function resizeAndStoreImage($origImagePath, $width, $height, $dstPath)
	{
		preg_match(ImageHelper::JPEG_REGEXP, $origImagePath, $jpeg_matches);
		preg_match(ImageHelper::JPG_REGEXP, $origImagePath, $jpg_matches);
		preg_match(ImageHelper::PNG_REGEXP, $origImagePath, $png_matches);

		if (count($jpeg_matches) > 0 || count($jpg_matches) > 0) {
			$origImage = imagecreatefromjpeg($origImagePath);
			$scaledImg = imagescale($origImage, $width, $height);
			imagejpeg($scaledImg, $dstPath);
		} elseif (count($png_matches) > 0) {
			$origImage = imagecreatefrompng($origImagePath);
			$scaledImg = imagescale($origImage, $width, $height);
			imagealphablending($scaledImg, false);
			imagesavealpha($scaledImg, true);
			imagepng($scaledImg, $dstPath);
		}
	}

	private static function resizeAndStoreImageToResolution(
		$origImagePath,
		$resWidth,
		$resHeight,
		$rootDir,
		$fileTitle,
		$prefixName
	) {
		$fullImagePath = public_path() . '/storage/' . $origImagePath;
		list($width, $height) = getimagesize($fullImagePath);

		if ($width >= 2 * $resWidth && $height >= 2 * $resHeight) {
			$dstPath = $rootDir . '/' . $prefixName . '-2x-bg-' . $fileTitle;
			ImageHelper::resizeAndStoreImage($fullImagePath, 2 * $resWidth, 2 * $resHeight, $dstPath);
		}
		if ($width >= $resWidth && $height >= $resHeight) {
			$dstPath = $rootDir . '/' . $prefixName . '-bg-' . $fileTitle;
			ImageHelper::resizeAndStoreImage($fullImagePath, $resWidth, $resHeight, $dstPath);
		}
	}

	public static function resizeAndStorePicture(
		$origImagePath,
		$rootDir,
		$fileTitle
	) {
		$fullImagePath = public_path() . '/storage/' . $origImagePath;
		list($width, $height) = getimagesize($fullImagePath);
		$dstPath = $rootDir . '/' . $fileTitle;
		ImageHelper::resizeAndStoreImage($fullImagePath, $width, $height, $dstPath);
	}

	/**
	 * Image Ratio 16/9
	 */
	public static function resizeAndStoreImageToFHD_16_9($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 1920, 1080, $rootDir, $fileTitle, '16_9-fhd');
	}

	public static function resizeAndStoreImageToHD_16_9($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 1280, 720, $rootDir, $fileTitle, '16_9-hd');
	}

	public static function resizeAndStoreImageToHDPlus_16_9($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 1600, 900, $rootDir, $fileTitle, '16_9-hdplus');
	}

	public static function resizeAndStoreImageToWXGA_16_9($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 1366, 768, $rootDir, $fileTitle, '16_9-wxga');
	}

	public static function resizeAndStoreImageToLG_16_9($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 1024, 576, $rootDir, $fileTitle, '16_9-lg');
	}

	public static function resizeAndStoreImageToMD_16_9($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 768, 432, $rootDir, $fileTitle, '16_9-md');
	}

	public static function resizeAndStoreImageToSM_16_9($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 640, 360, $rootDir, $fileTitle, '16_9-sm');
	}

	/**
	 * Image ratio 4/3
	 */
	public static function resizeAndStoreImageToXL_4_3($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 1440, 1024, $rootDir, $fileTitle, '4_3-xl');
	}

	public static function resizeAndStoreImageToLG_4_3($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 1024, 768, $rootDir, $fileTitle, '4_3-lg');
	}

	public static function resizeAndStoreImageToMD_4_3($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 768, 546, $rootDir, $fileTitle, '4_3-md');
	}

	public static function resizeAndStoreImageToSM_4_3($origImagePath, $rootDir, $fileTitle)
	{
		ImageHelper::resizeAndStoreImageToResolution($origImagePath, 640, 455, $rootDir, $fileTitle, '4_3-sm');
	}
}

ImageHelper::init();
