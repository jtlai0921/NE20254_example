<?php
// Last-Modified: Wed Oct 12 16:08:47 JST 2005
//
// Imagelist Parameters(JPEG Image Icon Creation Parameters)
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//	Mon Jan 22 01:22:57 JST 2001
//
// 2005-10-06 JuK Add zoom and aspect(fit/max/trim) options
// 2005-02-06 JuK Del root_directory_*, image_folder and so on.
// 2005-01-05 JuK Add image_folder(image directories folder)
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

// $original_directory: original image directory.
$original_directory='';
// $thumbnail_directory: thumbnailed image file directory.
$thumbnail_directory='scratch';
// $work_directory: resized work image file directory.
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
// $list_type: image listing type(0: table, 1: browse, 2: simple)
$list_type=1;
// $jpeg_quality: jpeg image quality when create.
$jpeg_quality=70;
// $smooth_resize: smoothing image when resize(requires mutch CPU).
$smooth_resize=true;
// $zoom_in_out: zooming or not (-1: no zoom, 0: zoom out only, 1: zoom)
$zoom_in_out=0;
// $resize_aspect: fitting or trimming methed when resize
//                                (0: fit in, 1: max aspect, 2: trim out)
$resize_aspect=1;
// $edit_rmk_mode: how edit the remarks
//                            (a:append, o:overwrite, r:readonly, n:none)
$edit_rmk_mode='o';
// $pict_frame_band: picture frame band pixcels (-1: no frame, 0: auto)
$pict_frame_band='-1';
// $pict_frame_label: label size on picture frame (-1: no label, 0: auto).
$pict_frame_label='-1';

// $max_uploads: maximum number of image files in list
$max_uploads=100;

?>
