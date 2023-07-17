# Consultas principais Herói do Coliseu
## Fase de quinto semestre

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://github.com/lukasrmdl/Game-dev)

Para iniciar as consultas antes rode "php artisan tinker".

## Consultas

- use App\Models\Topic -> Topic::where('edited', true) -> get()
- use App\Models\User  -> User::where('email_verified_at', NULL)->get
- use App\Models\Topic -> Topic::get(); 
- use App\Models\Comment -> Comment::get(); 
- use App\Models\User -> User::get(); 
- use App\Models\User -> $user = User::find(1) -> $topics = $user->topics;
- use App\Models\User -> $user = User::find(1) -> $comments = $user->comments;


