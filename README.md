# Transaction model

```php
class Transaction extends Model
{
    protected $fillable = [
        'paycom_transaction_id',
        'paycom_time',
        'paycom_time_datetime',
        'create_time',
        'perform_time',
        'cancel_time',
        'amount',
        'state',
        'reason',
        'receivers',
        'order_id',
        'perform_time_unix',
    ];

    public static function getTransactionsByTimeRange($from, $to)
    {
        return self::whereBetween('paycom_time', [$from, $to])
            ->get();
    }
}
```

# Transaction migration

```php
 $table->string('paycom_transaction_id', 25)->nullable();
 $table->string('paycom_time', 13)->nullable();
 $table->string('paycom_time_datetime', 255)->nullable();
 $table->dateTime('create_time')->nullable();
 $table->dateTime('perform_time')->nullable();
 $table->string('cancel_time', 13)->nullable();
 $table->integer('amount')->nullable();
 $table->tinyInteger('state')->nullable();
 $table->tinyInteger('reason')->nullable();
 $table->text('receivers')->nullable();
 $table->integer('order_id')->nullable();
 $table->string('perform_time_unix', 13)->nullable();
```
