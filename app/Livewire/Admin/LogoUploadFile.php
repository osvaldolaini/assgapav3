<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Configs;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class LogoUploadFile extends Component
{
    use WithFileUploads;

    public $uploadimage;
    public $configs;
    public $logo;
    public $rules;

    public function mount()
    {
        // $this->uploadimage = $uploadimage;
        $this->configs = Configs::find(1);
        $this->logo = $this->configs->logo_path.'.png';
    }
    public function render()
    {
        return view('livewire.admin.logo-upload-file');
    }
    public function uploadLogo()
    {
        $this->rules = [
            'uploadimage'   => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];

        $this->validate();
        if (isset($this->uploadimage)) {
            Storage::deleteDirectory('public/logos');
            $ext = $this->uploadimage->getClientOriginalExtension();
            $code = Str::uuid();
            $new_name = $code . '.' . $ext;
            $this->uploadimage->storeAs('public/logos', $new_name);
            $this->configs->logo_path = $code;
            $this->configs->save();
            // Storage::delete('public/logos/' . $this->logo);
            $this->logo = $new_name;

            $this->logo('storage/logos/' . $new_name,$code );
        }
        $this->openAlert('success', 'Logo atualizado com sucesso.');
    }
    public function excluirTemp()
    {
        $this->uploadimage = '';
    }
    public function excluirLogo()
    {
        $this->configs->logo_path = '';
        $this->configs->save();
        Storage::deleteDirectory('public/logos');
        $this->logo = $this->configs->logo_path;
    }
    //pega o status do registro
    public function openAlert($status, $msg)
    {
        $this->dispatch('openAlert', $status, $msg);
    }

    /**Logo e favicons */
    public static function logo($image,$code)
    {
        $logoWebp = Image::make($image);
        $logoWebp->encode('webp', 95);
        $logoWebp->save('storage/logos/'.$code.'.webp');
        // Logos footer e Header
        $footer = Image::make($image);
        $footer->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $footer->save('storage/logos/logo-footer.png', 100);
        $footer->encode('webp', 95);
        $footer->save('storage/logos/logo-footer.webp');

        $header = Image::make($image);
        $header->resize(null, 130, function ($constraint) {
            $constraint->aspectRatio();
        });
        $header->save('storage/logos/logo-header.png', 100);
        $header->encode('webp', 95);
        $header->save('storage/logos/logo-header.webp');

        if (Storage::directoryMissing('public/logos/favicons')) {
            Storage::makeDirectory('public/logos/favicons');
        }
        // Favicons
        $fav16 = Image::make($image);
        $fav16->resize(null, 16, function ($constraint) {
            $constraint->aspectRatio();
        });
        $fav16->save('storage/logos/favicons/favicon-16x16.png', 100);

        $fav32 = Image::make($image);
        $fav32->resize(null, 32, function ($constraint) {
            $constraint->aspectRatio();
        });
        $fav32->save('storage/logos/favicons/favicon-32x32.png', 100);

        $fav96 = Image::make($image);
        $fav96->resize(null, 96, function ($constraint) {
            $constraint->aspectRatio();
        });
        $fav96->save('storage/logos/favicons/favicon-96x96.png', 100);

        // MS ICON
        $ms70 = Image::make($image);
        $ms70->resize(null, 70, function ($constraint) {
            $constraint->aspectRatio();
        });
        $ms70->save('storage/logos/favicons/ms-icon-70x70.png', 100);

        $ms144 = Image::make($image);
        $ms144->resize(null, 144, function ($constraint) {
            $constraint->aspectRatio();
        });
        $ms144->save('storage/logos/favicons/ms-icon-144x144.png', 100);

        $ms150 = Image::make($image);
        $ms150->resize(null, 150, function ($constraint) {
            $constraint->aspectRatio();
        });
        $ms150->save('storage/logos/favicons/ms-icon-150x150.png', 100);

        $ms310 = Image::make($image);
        $ms310->resize(null, 310, function ($constraint) {
            $constraint->aspectRatio();
        });
        $ms310->save('storage/logos/favicons/ms-icon-310x310.png', 100);
        // Android Chrome
        $andC192 = Image::make($image);
        $andC192->resize(null, 192, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andC192->save('storage/logos/favicons/android-chrome-192x192.png', 100);

        $andC512 = Image::make($image);
        $andC512->resize(null, 512, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andC512->save('storage/logos/favicons/android-chrome-512x512.png', 100);
        // Android Icon
        $andI36 = Image::make($image);
        $andI36->resize(null, 36, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andI36->save('storage/logos/favicons/android-icon-36x36.png', 100);

        $andI48 = Image::make($image);
        $andI48->resize(null, 48, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andI48->save('storage/logos/favicons/android-icon-48x48.png', 100);

        $andI72 = Image::make($image);
        $andI72->resize(null, 72, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andI72->save('storage/logos/favicons/android-icon-72x72.png', 100);

        $andI96 = Image::make($image);
        $andI96->resize(null, 96, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andI96->save('storage/logos/favicons/android-icon-96x96.png', 100);

        $andI144 = Image::make($image);
        $andI144->resize(null, 144, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andI144->save('storage/logos/favicons/android-icon-144x144.png', 100);

        $andI192 = Image::make($image);
        $andI192->resize(null, 192, function ($constraint) {
            $constraint->aspectRatio();
        });
        $andI192->save('storage/logos/favicons/android-icon-192x192.png', 100);

        // Iphone Icon
        $I57 = Image::make($image);
        $I57->resize(null, 57, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I57->save('storage/logos/favicons/apple-icon-57x57.png', 100);

        $I60 = Image::make($image);
        $I60->resize(null, 60, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I60->save('storage/logos/favicons/apple-icon-60x60.png', 100);

        $I72 = Image::make($image);
        $I72->resize(null, 72, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I72->save('storage/logos/favicons/apple-icon-72x72.png', 100);

        $I76 = Image::make($image);
        $I76->resize(null, 76, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I76->save('storage/logos/favicons/apple-icon-76x76.png', 100);

        $I114 = Image::make($image);
        $I114->resize(null, 114, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I114->save('storage/logos/favicons/apple-icon-114x114.png', 100);

        $I120 = Image::make($image);
        $I120->resize(null, 120, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I120->save('storage/logos/favicons/apple-icon-120x120.png', 100);

        $I144 = Image::make($image);
        $I144->resize(null, 144, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I144->save('storage/logos/favicons/apple-icon-144x144.png', 100);

        $I152 = Image::make($image);
        $I152->resize(null, 152, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I152->save('storage/logos/favicons/apple-icon-152x152.png', 100);

        $I180 = Image::make($image);
        $I180->resize(null, 180, function ($constraint) {
            $constraint->aspectRatio();
        });
        $I180->save('storage/logos/favicons/apple-icon-180x180.png', 100);

        $apple = Image::make($image);
        $apple->resize(null, 192, function ($constraint) {
            $constraint->aspectRatio();
        });
        $apple->save('storage/logos/favicons/apple-icon.png', 100);

        $appleP = Image::make($image);
        $appleP->resize(null, 192, function ($constraint) {
            $constraint->aspectRatio();
        });
        $appleP->save('storage/logos/favicons/apple-icon-precomposed.png', 100);

        $appleT = Image::make($image);
        $appleT->resize(null, 180, function ($constraint) {
            $constraint->aspectRatio();
        });
        $appleT->save('storage/logos/favicons/apple-touch-icon.png', 100);
        // Storage::move('storage/logos/favicons','public/favicons');

    }
}
