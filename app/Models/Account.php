<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

/**
 * @property integer $id
 * @property string  $userid
 * @property string  $password
 * @property integer $permit_application
 * @property integer $permit_loan
 * @property integer $permit_refund
 * @property integer $permit_statistic
 * @property integer $permit_master
 * @property integer $permit_negotiate
 * @property integer $permit_account
 * @property string  $remember_token
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder where(string | array | \Closure $column, string $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Model limitOffset($limit, $offset)
 * @method static \Illuminate\Database\Eloquent\Builder|Model sort($sort_str)
 * @method static \Illuminate\Database\Eloquent\Builder|Model orderBy(string $column, string $direction = 'asc')
 */
class Account extends Authenticatable
{
    const SESSION_KEY_DATE = 'session_date';

    use SoftDeletes;

    protected $table = 'accounts';

    /**
     * 日付（Carbonインスタンス）へキャストする属性
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'first_name_kana',
        'last_name_kana',
    ];

    protected $hidden = [
        'password',
    ];

    public function getName()
    {
        return $this->first_name;
    }

    /**
     * 処理日の取得
     *
     * @string yyyy-mm-dd
     */
    public function getDate()
    {
        $add = 0;
        if (Session::has(self::SESSION_KEY_DATE)) {
            $add = Session::get(self::SESSION_KEY_DATE);
        }

        return Carbon::now()
            ->addDay($add)
            ->format('Y-m-d')
            ;
    }

    /**
     * 処理年度の取得
     *
     * @string yyyy
     */
    public function getYear()
    {
        // 処理日
        $date = Carbon::parse($this->getDate() . ' 00:00:00');

        $nendo = Carbon::parse(
            sprintf('%d-%s 00:00:00', $date->format('Y'), config('my.system.year_beginning'))
        );

        if ($date < $nendo) {
            $date->subYear();
        }

        return $date->format('Y');
    }
}
