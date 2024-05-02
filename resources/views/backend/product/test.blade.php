var modelPath = product3dImage ? "{{ asset($product->product3dImage->image_source) }}" : '';
    var scaleX = product3dImage ? {{ $product->product3dImage->scale_x }} : 0.04;
    var scaleY = product3dImage ? {{ $product->product3dImage->scale_y }} : 0.04;
    var scaleZ = product3dImage ? {{ $product->product3dImage->scale_z }} : 0.04;
    var background = product3dImage ? {{ $product->product3dImage->background }} : '0xffffff';
    var directional_light_color = product3dImage ? {{ $product->product3dImage->directional_light_color }} : '0xffffff';
    var directional_light_opacity = product3dImage ? {{ $product->product3dImage->directional_light_opacity }} : 5;
    var ambient_light_color = product3dImage ? {{ $product->product3dImage->ambient_light_color }} : '0xffffff';
    var ambient_light_opacity = product3dImage ? {{ $product->product3dImage->ambient_light_opacity }} : 3;
    var target_x = product3dImage ? {{ $product->product3dImage->target_x }} : 0;
    var target_y = product3dImage ? {{ $product->product3dImage->target_y }} : 1;
    var target_z = product3dImage ? {{ $product->product3dImage->target_z }} : 0;