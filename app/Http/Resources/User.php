<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request)
    {

        $email_verified_at = ($this->email_verified_at) ? $this->email_verified_at->format('H:i:s d-m-Y') : null;

        return [
          'id' => $this->id,
          'name' => $this->name,
          'email' => $this->email,
          'avatar' => $this->avatar_url,
          'email_verified_at' => $email_verified_at,
          'created_at' => $this->created_at->diffForHumans(),
          'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
