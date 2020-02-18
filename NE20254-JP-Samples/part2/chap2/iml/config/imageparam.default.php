<?php
// Last-Modified: Mon Dec 07 12:26:14 JST 2003
//
// JPEG Image Icon Creation Parameters
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//	Mon Jan 22 01:22:57 JST 2001
//
// 2005-02-01 JuK Del root_directory_* and image_folder move to param.xml
// 2003-12-07 JuK Add smooth_resize
// 2003-11-24 JuK Add pict_frame_band
// 2003-09-26 JuK Add max_uploads
// 2003-07-20 JuK Add root_path and make this template
// 2002-08-28 JuK Add edit mode for remarks(readonly or none)
// 2002-07-04 JuK Add edit mode for remarks(append or overwrite)
// 2002-03-15 JuK independent browse size.
// 2001-06-03 JuK generate present file in work directory.
//
$TEST=0;

// $original_directory: original image files directory.
$original_directory='';
// $thumbnail_directory: thumbnailed image files directory.
$thumbnail_directory='scratch';
// $work_directory: resized work image files directory.
$work_directory='work';
// $browse_width: expected window width on browser in pixels.
$browse_width=800;
// $browse_height: expected window height on browser in pixels.
$browse_height=600;
// $thumbnail_width: thumbnail image width in pixels.
$thumbnail_width=128;
// $thumbnail_height: thumbnail image height in pixels.
$thumbnail_height=96;
// $thumblabel_length: label string length for thumbnail.
$thumblabel_length=16;
// $work_width: work image width in pixels.
$work_width=320;
// $work_height: work image height in pixels.
$work_height=240;
// $jpeg_quolity: jpeg image quolity when create.
$jpeg_quolity=70;
// $smooth_resize: smoothing image when resize(sampling requires mutch CPU).
$smooth_resize='true';
// $edit_rmk_mode: how edit the remarks(a:append, o:overwrite,
//                                      r:readonly, n:none)
$edit_rmk_mode='o';
// $pict_frame_band: picture frame band pixcels(-1: no frame, 0: auto)
$pict_frame_band='-1';
// $pict_frame_label: label size on picture frame(-1: no label, 0: auto).
$pict_frame_label=-1;

// $max_uploads: maximum number of image files in list
$max_uploads=100;
?>
