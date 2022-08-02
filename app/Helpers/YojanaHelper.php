<?php

namespace App\Helpers;

use App\Models\SharedModel\Setting;

class YojanaHelper
{
    public function getRelationNameViaSession($relation = '')
    {
        $realtionName = "";
        switch ($relation) {
            case config('TYPE.tole-bikas-samiti'):
                $realtionName = 'toleBikasSamitiDetails';
                break;
            case config('TYPE.UPABHOKTA_SAMITI'):
                $realtionName = 'consumerDetails';
                break;
            case config('TYPE.SANSTHA_SAMITI'):
                $realtionName = 'institutionalCommitteeDetail';
                break;
            default:
                $realtionName = "";
                break;
        }
        return $realtionName;
    }

    public function getPostViasSession($type_id = '')
    {
        switch ($type_id) {
            case config('TYPE.tole-bikas-samiti'):
                $posts = Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues', function ($q) {
                        $q->where('id', config('constant.TOLE_SAMYOJAK_ID'))
                            ->orWhere('id', config('constant.TOLE_SADASYA_ID'));
                    })
                    ->first();
                break;
            case config('TYPE.UPABHOKTA_SAMITI'):
                $posts = Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues', function ($q) {
                        $q->where('id', '!=', config('constant.TOLE_SAMYOJAK_ID'));
                    })
                    ->first();
                break;
            case config('TYPE.SANSTHA_SAMITI'):
                $posts = Setting::query()
                    ->where('slug', config('SLUG.samiti_post'))
                    ->with('settingValues')
                    ->first();
                break;
            default:
                $posts = [];
                break;
        }
        return $posts;
    }
}
