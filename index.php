<?php
require_once 'class.php';
$musteri='musterinumaraniz';
$sifre='sifreniz';
$sendeo = new Sendeo($musteri,$sifre);

/*
•	DeliveryType 1: Lokasyonunuz >> Müşteriniz: Lokasyon’dan Müşteriye giden gönderilerde kullanılmaktadır. Birden fazla lokasyon var ve her biri için ayrı fatura düzenlenecek ise; farklı kullanıcılar ile yönetilmelidir. Eğer fatura Ana Müşteriye düzenlenecek ise deliveryType=3 kullanılmalıdır.
•	DeliveryType 2: Müşteriniz >> Lokasyonunuz : Müşteriden Lokasyona normal gönderi ya da iade gönderisi yapmak için kullanılmaktadır
•	DeliveryType 3: Tedarikçiniz v.b. >> Müşteriniz  
•	DeliveryType 4: Yeniden gönderi talimatı 
•	DeliveryType 5: Teslimat Noktası . Sendeo Teslimat noktasına teslim edilecek gönderiler için kullanılmaktadır
•	DeliveryType 6: İade Noktası. Sendeo İade noktasından alınacak gönderiler için kullanılmaktadır

*/				

$DeliveryData=[];
$DeliveryData['DeliveryType']		=1;			//integer,Zorunlu;
$DeliveryData['ReferenceNo']		=1234;	//string,Zorunlu.Müşterilerin iç işleyişinde kullandığı referans numarasını içerir. Bu değer ile gönderiler takip edebilir, iade talepleri oluşturabilir.
$DeliveryData['Description']		='';		//string,Zorunlu değil.Gönderiye ait özel bir bilgi veya açıklama girmek isterseniz bu alanı kullanabilirsiniz.
$DeliveryData['Sender']				='.....Tic. A.Ş.';//string,Değişken.Gönderen müşteri ünvanını içerir. DeliveryType = 2,3 için zorunludur.DeliveryType = 1 için doldurulmaz.
$DeliveryData['SenderId']			='';//string,Zorunlu değil.Sendeo tarafında olan müşteri kodu bilgisidir. Sendeo tarafında kayıtlı müşteriler kullanılmıyor ise ilgili alan gönderilmemesi gerekmektedir.
$DeliveryData['SenderAuthority']	='';		//string,Zorunlu değil.Gönderen müşteri yetkilinizi belirtir.
$DeliveryData['SenderBranchCode']	='';		//integer,Değişken.İade noktası operasyonunda gönderilmesi zorunlu alandır. DeliveryType = 6 seçilmemesi durumunda boş bırakılmalıdır..
$DeliveryData['SenderAddress']		='İZMİR';//string,Zorunlu;
$DeliveryData['SenderCityId']		=35;		//integer,Zorunlu.City tablosundan gelecek şehir Id’si ile gönderen müşteri ili olarak girilmelidir.
$DeliveryData['SenderDistrictId']	=3746607;		//integer,Zorunlu.District tablosundan gelecek Id gönderen müşterinin bulunduğu ilçe girilmelidir.;
$DeliveryData['senderPhone']		='2321111111';//string,Değişken.Gönderen müşterinin telefon numarasını belirtir. İdealde xyz1234567 şeklinde 10 hane olarak gönderilmesi beklenmektedir.Phone veya GSM alanlarından bir tanesi mutlaka gönderilmelidir.
$DeliveryData['SenderGSM']			='5321111111';//string,Değişken.Gönderen müşterinin GSM numarasını belirtir. İdealde 5xx1234567 şeklinde 10 hane olarak gönderilmesi beklenmektedir.Phone veya GSM alanlarından bir tanesi mutlaka gönderilmelidir.
$DeliveryData['SenderEmail']		='';			//string,Zorunlu değil.Gönderen müşterinin mail adresini içerir.

$DeliveryData['Receiver']			='Alıcı İsim Soyisim';	//string,Değişken.deliveryType = 1,3 için zorunludur.deliveryType = 2 için doldurulmaz.
$DeliveryData['ReceiverId']			='';		//string,Değişken.Alıcı müşterinin kodudur. Sendeo tarafında değeri biliniyor ise gönderilmelidir.
$DeliveryData['ReceiverAuthority']	='';		//string,Zorunlu değil.Alıcı müşteri yetkilisini belirtir.
$DeliveryData['ReceiverBranchCode']	='';		//integer,Değişken.Teslimat noktası operasyonunda gönderilmesi zorunlu alandır. deliveryType = 5 seçilmemesi durumunda boş bırakılmalıdır..
$DeliveryData['ReceiverAddress']	='Alıcı adres';//string,Değişken.Alıcı müşterinin adres bilgileri girilmelidir.Alıcı müşteri ünvanını içerir. deliveryType = 1,3 için zorunludur.deliveryType = 2 için doldurulmaz.
$DeliveryData['ReceiverCityId']		='ilId'		//integer,Zorunlu.City tablosundan gelecek şehir Id’si ile alıcı müşteri ili olarak girilmelidir.
$DeliveryData['ReceiverDistrictId']	='ilceId';		//integer,Zorunlu.District tablosundan gelecek Id gönderen müşterinin bulunduğu ilçe girilmelidir.;
$DeliveryData['receiverPhone']		='2321111111';//string,Değişken.Alıcı müşterinin telefon numarasını belirtir. İdealde xyz1234567 şeklinde 10 hane olarak gönderilmesi beklenmektedir.Phone veya GSM alanlarından bir tanesi mutlaka gönderilmelidir.
$DeliveryData['ReceiverGSM']		='5321111111';//string,Değişken.Alıcı müşterinin GSM numarasını belirtir. İdealde 5xx1234567 şeklinde 10 hane olarak gönderilmesi beklenmektedir.Phone veya GSM alanlarından bir tanesi mutlaka gönderilmelidir.
$DeliveryData['SenderEmail']		='';			//string,Zorunlu değil.Alıcı müşterinin mail adresini içerir.
$DeliveryData['PaymentType']		=1;			//integer,Zorunlu.Standart olarak 1 girilmelidir.
$DeliveryData['CollectionType']		=0;			//integer,Zorunlu.Tahsilatlı kargolarda ödeme şeklini gösterir:0 – Tahsilatsız kargo 1 – Nakit 2 – Kredi Kartı
$DeliveryData['dispatchNoteNumber']	='';		//string,Zorunlu değil.Müşteriye oluşturulan resmi irsaliye seri ve numarasını içerir. Giriş yapılması halinde buna göre gönderiler sorgulanabilir.
$DeliveryData['ServiceType']		=1;		//integer,Zorunlu.Servis tipini belirtir. Özel operasyonlar dışında default 1 gönderilmelidir.
$DeliveryData['barcodeLabelType']		=1;		//integer,Zorunlu.Servis dönüşünde alınacak barkod etiket yazdırma tipini belirtir.0 – ZPL, 1 – Base64, 2 – ZPL, 3 – ZPLs, Array olarak alınan gönderi bilgilerinin detayıdır. Toplam adet şeklinde gönderilebileceği gibi aynı zamanda gönderileri detaylandırıp farklı şekillerde girilebilir.
$DeliveryData['customerReferenceType']		='';		//string,Zorunlu değil.referenceNo alanının müşteri iş işleyişinde referans bazlı gönderi ayırmaya yeterli olmadığı durumlar için müşterinin daha fazla detay girebilmesini sağlayan alandır.

$Count=1;//integer,Zorunlu.Gönderi adetini belirtir. Her bir detay için adet girilmelidir. Count toplamı kadar barkod numarası oluşur.
$Deci=0;
/*
Gönderiye ait paketlerin deci bilgilerini içerir. count ile beraber kullanılmaktadır. Gönderilmediği durumda ölçüm Sendeo Operasyon’da yapılmaktadır.
Tek gönderi biri 3 deci, diğeri 4 deci olan 2 kutunuz varsa:
-	count : 1, deci : 4
-	count : 1, deci : 3
gönderilir.
Tek gönderi iki adet 5 deci kutudan oluşuyorsa:
-	count : 2, deci : 5
gönderilir.
Deci ya da kg ölçülememesi durumunda 0(sıfır) olarak gönderilmelidir.

*/

$ProductCode='';//string,Zorunlu değil.Boş string olarak gönderilmelidir.
$Description='';//string,Zorunlu değil.Ürüne ilişkin açıklama bilgisidir.Boş string olarak gönderilmelidir.
$DeliveryData['products'][]		=['Count'=>$Count,'Deci'=>$Deci,'ProductCode'=>$ProductCode,'Description'=>$Description];


$result= json_decode($sendeo->SetDelivery($DeliveryData),true);

print_r($result);


