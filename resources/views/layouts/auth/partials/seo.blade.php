<meta name="description" content="{{isset($object['intro']) ? $object['intro'] : $data['intro']->value}}"/>
<meta name="keywords" content="{{isset($object['keyword']) ? $object['keyword'] : $data['keyword']->value}}"/>
<meta http-equiv="refresh" content="1800"/>
<meta name="robots" content="noarchive,noodp,index,follow" />
<meta name="googlebot" content="noarchive,index,follow" />
<meta name='revisit-after' content='1 days'/>

<!-- For Facebook -->
<meta property="og:title" content="{{isset($object['title']) ? $object['title'] : $data['title']}}"/>
<meta property="og:type" content="article"/>
<meta property="og:image" content="{{isset($object['image']) ? url($object['image']) : url('images/qrcode-vj.png')}}"/>
<meta property="og:url" content="{{url('')}}"/>
<meta property="og:description" content="{{isset($object['intro']) ? $object['intro'] : $data['intro']->value}}"/>
<!-- End for Facebook -->

<!-- For Twitter -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="{{isset($object['title']) ? $object['title'] : $data['title']}}"/>
<meta name="twitter:description" content="{{isset($object['intro']) ? $object['intro'] : $data['intro']->value}}"/>
<meta name="twitter:image" content="{{isset($object['image']) ? url($object['image']) : url('images/qrcode-vj.png')}}"/>
<!-- End for Twitter -->