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
        if (!empty($oldImage)) {
            deleteImage($path, $oldImage);
        }

        return $fileName;

    }

    return null;
}

function deleteImage($path, $nameFile)
{
    //check file exists
    if (file_exists($imageDestinationPath = $path.$nameFile) && !preg_match('#default#', $nameFile)) {
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

function modalLogin()
{
    if (!Auth::check()) {
        return 'data-toggle=modal data-target=#auth-modal';
    }

    return;
}

function attrUser($class)
{
    if (Auth::check()) {
        return $class;
    }

    return;
}
