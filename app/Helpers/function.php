<?php
/**
 * Upload Image
 *
 * @param  string $oldImage
 *
 * @return mixed
 */
function uploadImage($image, $path, $oldImage = null)
{
    if ($image) {
        //set unique name avatar
        $fileName = uniqid(time()) . '.' . $image->getClientOriginalExtension();

        //move directory folder image
        $image->move($path, $fileName);

        //delete old image for update image2wbmp(image)
        if (!empty($oldImage) && !strpos($oldImage, 'default')) {
            deleteImage($path, $oldImage);
        }

        return $fileName;

    }

    return null;
}

function deleteImage($path, $nameFile)
{
    //check file exists
    if (file_exists($imageDestinationPath = $path.$nameFile)) {
        File::delete($imageDestinationPath);
    }

    return false;
}

function flashMessage($item, $action, $status, $alert = 'success')
{
    return flash(trans('common.noty.message', [
        'item' => $item,
        'action' => $action,
        'status' => $status,
    ]), $alert);
}
