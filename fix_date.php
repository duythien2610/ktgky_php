<?php
use Illuminate\Support\Facades\DB;
DB::statement("UPDATE san_pham SET created_at = '2024-01-01 00:00:00' WHERE created_at = '0000-00-00 00:00:00'");
DB::statement("UPDATE san_pham SET updated_at = '2024-01-01 00:00:00' WHERE updated_at = '0000-00-00 00:00:00'");
echo "Done";
