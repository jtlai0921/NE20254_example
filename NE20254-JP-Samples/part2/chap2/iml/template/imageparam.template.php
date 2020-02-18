<?php
// Last-Modified: $timestamp
//
// Imagelist Parameters(JPEG Image Icon Creation Parameters)
//
// Jun Kuwamura <juk@yokohama.email.ne.jp>
//	Mon Jan 22 01:22:57 JST 2001
//
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
\$TEST=$TEST;

// \$original_directory: original image directory.
\$original_directory='$original_directory';
// \$thumbnail_directory: thumbnailed image file directory.
\$thumbnail_directory='$thumbnail_directory';
// \$work_directory: resized work image file directory.
\$work_directory='$work_directory';
// \$browse_width: expected window width on browser in pixels.
\$browse_width=$browse_width;
// \$browse_height: expected window height on browser in pixels.
\$browse_height=$browse_height;
// \$thumbnail_width: thumbnail image width in pixels.
\$thumbnail_width=$thumbnail_width;
// \$thumbnail_height: thumbnail image height in pixels.
\$thumbnail_height=$thumbnail_height;
// \$thumblabel_length: label string length for thumbnail.
\$thumblabel_length=$thumblabel_length;
// \$work_width: work image width in pixels.
\$work_width=$work_width;
// \$work_height: work image height in pixels.
\$work_height=$work_height;
// \$jpeg_quolity: jpeg image quolity when create.
\$jpeg_quolity=$jpeg_quolity;
// \$smooth_resize: smoothing image when resize(sampling requires mutch CPU).
\$smooth_resize=$smooth_resize;
// \$edit_rmk_mode: how edit the remarks(a:append, o:overwrite,
//                                      r:readonly, n:none)
\$edit_rmk_mode='$edit_rmk_mode';
// \$pict_frame_band: picture frame band pixcels(-1: no frame, 0: auto)
\$pict_frame_band='$pict_frame_band';
// \$pict_frame_label: label size on picture frame(-1: no label, 0: auto).
\$pict_frame_label='$pict_frame_label';

// \$max_uploads: maximum number of image files in list
\$max_uploads=$max_uploads;

?>
