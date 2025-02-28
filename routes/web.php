<?php
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('block.direct');
?>