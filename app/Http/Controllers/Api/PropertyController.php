<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        // استرجاع جميع العقارات
        return Property::all();
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $validated = $request->validate([
            'type' => 'required|in:house,apartment',
            'address' => 'required|string',
            'size' => 'required|numeric',
            'bedrooms' => 'required|integer',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'price' => 'required|numeric',
        ]);

        // التحقق من وجود عقار بنفس العنوان والسعر
        $existingProperty = Property::where('address', $request->input('address'))
            ->where('type', $request->input('type'))
            ->where('price', $request->input('price'))
            ->first();

        if ($existingProperty) {
            // إذا كان العقار موجودًا
            return response()->json([
                'message' => 'عقار بنفس العنوان والسعر موجود بالفعل.',
                'data' => $existingProperty  // عرض البيانات مباشرة
            ], 409);  // تعارض البيانات
        }

        // إذا كانت البيانات غير متكررة، إنشاء عقار جديد
        $property = Property::create($validated);

        // إرجاع رسالة نجاح مع البيانات المدخلة
        return response()->json([
            'message' => 'تم إضافة العقار بنجاح!',
            'data' => $property  // عرض البيانات مباشرة
        ], 201);
    }

    public function search(Request $request)
    {
        // إنشاء استعلام
        $query = Property::query();

        // البحث عن طريق النوع
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        // البحث عن طريق العنوان
        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }

        // البحث عن طريق الحجم
        if ($request->has('size')) {
            $query->where('size', '>=', $request->input('size'));
        }

        // البحث عن طريق عدد الغرف
        if ($request->has('bedrooms')) {
            $query->where('bedrooms', '>=', $request->input('bedrooms'));
        }

        // البحث عن طريق السعر
        if ($request->has('price')) {
            $query->where('price', '<=', $request->input('price'));
        }

        // البحث ضمن نطاق جغرافي (اختياري)
        if ($request->has('latitude') && $request->has('longitude') && $request->has('radius')) {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $radius = $request->input('radius');  // المسافة بالكيلومتر

            // التأكد من أن القيم المدخلة صالحة
            if (is_numeric($latitude) && is_numeric($longitude) && is_numeric($radius)) {
                // استخدام MySQL Geo-queries لحساب المسافة بين النقاط الجغرافية
                $query->whereRaw("ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?", [
                    $longitude, 
                    $latitude, 
                    $radius * 1000  // تحويل الكيلومتر إلى متر
                ]);
            } else {
                // إذا كانت القيم غير صالحة
                return response()->json([
                    'error' => 'القيم المدخلة للموقع أو المسافة غير صحيحة.'
                ], 400); // رمز حالة 400 يعني أن البيانات المدخلة غير صحيحة
            }
        }

        // إرجاع نتائج البحث مع الترحيل (Pagination)
        $properties = $query->paginate(10);

        // التحقق إذا كانت النتائج فارغة
        if ($properties->isEmpty()) {
            return response()->json([
                'message' => 'لم يتم العثور على عقارات تتناسب مع المعايير المدخلة.'
            ], 404); // إذا كانت النتائج فارغة
        }

        // إرجاع النتائج مع تفاصيل الترحيل
        return response()->json([
            'data' => $properties->items(),  // عرض العقارات فقط
            'pagination' => [
                'total' => $properties->total(),
                'per_page' => $properties->perPage(),
                'current_page' => $properties->currentPage(),
                'last_page' => $properties->lastPage(),
            ]
        ]);
    }



}
