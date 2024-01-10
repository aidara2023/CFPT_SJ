<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'genre',
        'adresse',
        'telephone',
        'email',
        'password',
        'date_naissance',
        'lieu_naissance',
        'nationalite',
        'photo',
        'id_role',
        'matricule_nombre',
        'matricule',
        'status',

    ];
   /*  protected $primaryKey= 'matricule'; */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'id_role');
    }


    public function service() {
        return $this -> belongsTo(Service::class);
    }

    public function direction() {
        return $this -> belongsTo(Direction::class);
    }

    public function bibliothecaires(){
        return $this->hasMany(Bibliothecaire::class);
    }

    public function caissiers(){
        return $this->hasMany(Caissier::class);
    }

    public function emprunter_livres(){
        return $this->hasMany(Emprunter_livre::class);
    }

    public function dossiers_medical(){
        return $this->hasMany(Dossier_medical::class);
    }

    public function infirmiers(){
        return $this->hasMany(Infirmier::class);
    }

    public function tuteurs(){
        return $this->hasMany(Tuteur::class);
    }

    public function eleves(){
        return $this->hasMany(Eleve::class, 'id_user', 'id');
    }

    public function formateur(){
        return $this->hasMany(Formateur::class, 'id_user', 'id');
    }

    public function emprunter_materiels(){
        return $this->hasMany(Emprunter_livre::class);
    }
    public function consultations(){
        return $this->hasMany(Consultation::class);
    }

   /*  public static function generateur_matricule($prefix= 'M'){
        $dernier_user=self::orderBy('matricule_nombre', 'desc')->first();
        $prochain_nombre= $dernier_user ? $dernier_user->matricule_nombre + 1 : 10066;
        $matricule= $prefix . $prochain_nombre;
        $dernier_user->matricule_nombre= $dernier_user->matricule_nombre + 1;
        $dernier_user->save();
        return $matricule;
    } */

    public static function generateur_matricule($prefix = 'M') {
        $dernier_user = self::orderBy('matricule_nombre', 'desc')->first();

        if ($dernier_user) {
            $prochain_nombre = $dernier_user->matricule_nombre + 1;
            $dernier_user->matricule_nombre = $prochain_nombre;
            $dernier_user->save();
        } else {
            // Si aucun utilisateur existant, commencez à partir de 10066
            $prochain_nombre = 10066;
        }

        $matricule = $prefix . $prochain_nombre;
        return $matricule;
    }



    public static function getId($user){
        return $user->id;

    }
}
