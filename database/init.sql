CREATE DATABASE IF NOT EXISTS gradix;
USE gradix;

CREATE TABLE IF NOT EXISTS products (
  id VARCHAR(50) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  category VARCHAR(50) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  original_price DECIMAL(10, 2) NOT NULL,
  discount INT NOT NULL,
  image LONGTEXT NOT NULL,
  hover_image LONGTEXT NOT NULL,
  fabric VARCHAR(100),
  weave VARCHAR(100),
  color VARCHAR(50),
  rating DECIMAL(3, 1),
  reviews INT,
  description TEXT,
  highlights JSON
);

INSERT INTO products (id, name, category, price, original_price, discount, image, hover_image, fabric, weave, color, rating, reviews, description, highlights) VALUES
('saree-15', 'Royal crimse Silk Saree', 'sarees', 2999, 5000, 40, 'images/img-saree-red.jpg', 'images/img-saree-red.jpg', 'Silk', 'Traditional Weave', 'Red', 4.8, 12, 'An elegant royal crimson silk saree, perfect for festive occasions and celebrations. Features a beautiful drape and authentic silk texture.', '["Pure Silk Blend","Traditional Motifs","Rich Crimson Color","Lightweight & Comfortable"]'),
('saree-01', 'Royal Crimson Banarasi Silk Saree', 'sarees', 8499, 12999, 35, 'images/img-saree-red.jpg', 'images/img-saree-banarasi.jpg', 'Silk', 'Banarasi', 'Red', 4.8, 124, 'Indulge in royal heritage with this crimson Banarasi silk saree. Adorned with intricate zari work, handwoven by master artisans, it features a heavy pallu and a classic border, making it perfect for weddings and grand festivities.', '["Pure Katan Silk","Gold Zari Floral Jaal","Handcrafted in Varanasi","Silk Mark Certified"]'),
('saree-02', 'Golden Hour Kanjivaram Silk Saree', 'sarees', 9999, 15999, 37, 'images/img-saree-gold.jpg', 'images/img-saree-kanjivaram.jpg', 'Silk', 'Kanjivaram', 'Gold', 4.9, 86, 'An epitome of grace and South Indian tradition, this Kanjivaram silk saree features a dual-tone shimmer, gold korvai borders, and traditional temple motifs. The premium mulberry silk gives it a rich drape.', '["Pure Mulberry Silk","Pure Gold & Silver Zari","Temple Border Design","Silk Mark Certified"]'),
('saree-03', 'Sage Mint Organza Floral Saree', 'sarees', 3299, 4999, 34, 'images/img-saree-organza.jpg', 'images/img-saree-tussar.jpg', 'Organza', 'Chanderi Weave', 'Pastel', 4.5, 42, 'Embrace modern pastel minimalism with this mint green organza saree. It features hand-painted floral motifs and delicate scalloped embroidery borders, offering a lightweight and breezy silhouette.', '["Premium Light Organza","Hand-painted Florals","Scalloped Borders","Easy & Elegant Drape"]'),
('saree-04', 'Ocean Indigo Linen Jamdani Saree', 'sarees', 4599, 6499, 29, 'images/img-saree-kanjivaram.jpg', 'images/img-saree-red.jpg', 'Linen', 'Jamdani', 'Blue', 4.6, 58, 'Crafted from pure organic linen, this indigo saree features elegant Jamdani geometric motifs woven across the body. It blends organic texture with artistic craft, making it an excellent choice for office wear or daytime events.', '["100% Organic Linen","Breathable & Eco-friendly","Traditional Jamdani Weave","Handcrafted borders"]'),
('saree-05', 'Mustard Tussar Silk Saree', 'sarees', 5299, 7999, 33, 'images/img-saree-tussar.jpg', 'images/img-saree-organza.jpg', 'Silk', 'Tussar', 'Yellow', 4.4, 31, 'Revel in the rich, natural texture of Tussar silk. This mustard yellow saree boasts a contrast forest green border, block prints, and a decorated pallu highlighting rural folklore paintings.', '["Wild Tussar Silk","Natural Gold Texture","Traditional Block Prints","Craftmark Certified"]'),
('saree-06', 'Classic Ivory Cotton Mulmul Saree', 'sarees', 1999, 2999, 33, 'images/img-saree-banarasi.jpg', 'images/img-saree-red.jpg', 'Cotton', 'Chanderi Weave', 'Off-White', 4.7, 95, 'Enjoy maximum breathability with our ultra-soft ivory cotton mulmul saree. Highlighted with gold zari borders and matching thread embroidery, it offers a sophisticated casual summer style.', '["100% Cotton Mulmul","Feather-light & Soft","Zari Border Highlights","Handloom Mark"]'),
('saree-07', 'Emerald Chanderi Silk Cotton Saree', 'sarees', 3899, 5999, 35, 'images/img-saree-organza.jpg', 'images/img-saree-gold.jpg', 'Silk', 'Chanderi', 'Green', 4.5, 29, 'Elegant emerald green Chanderi saree woven with a blend of fine silk and organic cotton. Known for its sheer texture and lightweight elegance, finished with a classic golden border.', '["Chanderi Silk Cotton","Sheer Glamorous Drapes","Gold Zari Border","Handwoven Heritage"]'),
('saree-08', 'Blush Pink Tissue Silk Saree', 'sarees', 7699, 10999, 30, 'images/img-saree-tussar.jpg', 'images/img-saree-red.jpg', 'Tissue', 'Banarasi', 'Pastel', 4.8, 67, 'A glamorous sheen meets soft aesthetics in this blush pink Tissue silk saree. Highlighted with floral motifs in copper and silver zari threads, it flows beautifully and catches the light elegantly.', '["Shimmering Tissue Silk","Floral Zari Buttas","Copper Border Work","Silk Mark Certified"]'),
('saree-09', 'Deep Maroon Banarasi Katan Silk', 'sarees', 6199, 8999, 31, 'images/img-saree-red.jpg', 'images/img-saree-gold.jpg', 'Silk', 'Banarasi', 'Red', 4.6, 43, 'Crafted in deep maroon Katan Silk, this Banarasi masterpiece features a rich floral border and golden leaf bootis, ideal for festive celebrations and weddings.', '["100% Pure Katan Silk","Classic Floral Bootis","Heavy Pallu Design","Authentic Varanasi Weave"]'),
('saree-10', 'Peach Petals Georgette Saree', 'sarees', 3499, 4999, 30, 'images/img-saree-organza.jpg', 'images/img-saree-tussar.jpg', 'Georgette', 'Printed', 'Pastel', 4.3, 19, 'A soft, pastel peach Georgette saree featuring delicate printed petals and an elegant border lace. It is lightweight and drapes gracefully.', '["Flowy Georgette","Pastel Floral Prints","Lace Border Accents","Casual & Evening Elegance"]'),
('saree-11', 'Antique Gold Chanderi Silk Saree', 'sarees', 4199, 5999, 30, 'images/img-saree-gold.jpg', 'images/img-saree-kanjivaram.jpg', 'Silk', 'Chanderi', 'Gold', 4.5, 22, 'An antique golden Chanderi saree woven with high-grade silk threads. Boasts traditional coin buttas and a sheer body that feels highly premium.', '["Chanderi Silk Threads","Coin Butta Weaving","Lightweight Sheer Drape","Craftmark Authenticated"]'),
('saree-12', 'Emerald Palace Kanjivaram Saree', 'sarees', 11199, 17999, 37, 'images/img-saree-kanjivaram.jpg', 'images/img-saree-gold.jpg', 'Silk', 'Kanjivaram', 'Green', 4.9, 55, 'Dress in royal luxury with this emerald green Kanjivaram silk saree. Highlighted with handloom temple patterns and a massive gold zari pallu.', '["Pure South Silk","Massive Gold Zari Pallu","Traditional Temple Patterns","Silk Mark Certified"]'),
('saree-13', 'Summer Indigo Handblock Cotton Saree', 'sarees', 2499, 3499, 28, 'images/img-saree-banarasi.jpg', 'images/img-saree-organza.jpg', 'Cotton', 'Printed', 'Blue', 4.7, 78, 'Classic hand-block print cotton saree made in Jaipur. Breathable, comfortable, and printed with organic indigo vegetable dyes.', '["100% Jaipur Cotton","Organic Vegetable Dyes","Hand-block Printing","Perfect for Warm Weather"]'),
('saree-14', 'Ivory Harvest Printed Linen Saree', 'sarees', 3799, 5499, 30, 'images/img-saree-tussar.jpg', 'images/img-saree-red.jpg', 'Linen', 'Printed', 'Off-White', 4.6, 35, 'A soft, ivory-colored organic linen saree printed with artistic leaf layouts and bordered with silver-threaded borders.', '["Organic Flax Linen","Leaf Print Layout","Silver Border Weaving","Elegant Casual Wear"]'),
('kurta-01', 'Ruby Embroidered Anarkali Kurta Set', 'kurtas', 3499, 5499, 36, 'images/img-kurta-anarkali.jpg', 'images/img-kurta-yellow.jpg', 'Silk Blend', 'Printed', 'Red', 4.6, 73, 'An elegant ruby red Anarkali kurta crafted from premium silk blend. Features detailed gota-patti and thread embroidery along the neck and cuffs, paired with printed pants and an organza dupatta.', '["Anarkali Silhouette","Gota Patti Neckline","Silk Blend Fabric","Complete 3-Piece Set"]'),
('kurta-02', 'Mustard A-Line Cotton Kurta Set', 'kurtas', 2199, 3499, 37, 'images/img-kurta-yellow.jpg', 'images/img-kurta-blue.jpg', 'Cotton', 'Printed', 'Yellow', 4.5, 110, 'A cheerful mustard yellow A-Line kurta with subtle floral block prints. Pairs with comfortable cropped trousers and is ideal for casual outings or festive daywear.', '["100% Pure Cotton","Floral Block Prints","A-Line fit with pockets","Highly breathable"]'),
('kurta-03', 'Sage Pastel Chanderi Straight Kurta', 'kurtas', 2899, 3999, 28, 'images/img-kurta-blue.jpg', 'images/img-kurta-anarkali.jpg', 'Chanderi', 'Chanderi Weave', 'Pastel', 4.7, 54, 'Infuse serene style with this sage green straight-cut Chanderi kurta. Accented with self-thread embroidery and delicate gold highlights, paired with ivory straight pants.', '["Premium Chanderi Blend","Intricate Self-Embroidery","Straight Comfort Fit","Includes inner lining"]'),
('kurta-04', 'Indigo Blue Bandhani Print Kurta Set', 'kurtas', 2499, 3799, 34, 'images/img-kurta-anarkali.jpg', 'images/img-kurta-blue.jpg', 'Cotton', 'Printed', 'Blue', 4.4, 38, 'Classic Indigo blue cotton kurta featuring traditional Rajasthani Bandhani prints. Features a V-neck style and comes with printed palazzo pants for maximum comfort and style.', '["Breathable Cotton","Traditional Bandhani Motif","Relaxed Palazzo Bottoms","Colour-fast material"]'),
('kurta-05', 'Peach Floral Georgette Suit Set', 'kurtas', 3999, 5999, 33, 'images/img-kurta-yellow.jpg', 'images/img-kurta-anarkali.jpg', 'Georgette', 'Printed', 'Pastel', 4.3, 21, 'Graceful peach suit set featuring an elegant floral-patterned Georgette kurta, matching solid leggings, and a soft chiffon dupatta with golden border lace.', '["Lightweight Georgette","Lace Border Accents","Fluid Flare Fit","Chiffon Dupatta Included"]'),
('kurta-06', 'Olive Khadi Cotton Short Kurti', 'kurtas', 1299, 1999, 35, 'images/img-kurta-blue.jpg', 'images/img-kurta-yellow.jpg', 'Cotton', 'Khadi Weave', 'Green', 4.6, 82, 'Celebrate organic fashion with this olive green short kurti crafted in hand-spun Khadi cotton. Features front wooden buttons and convenient pockets. Ideal to style with denims or trousers.', '["Hand-spun Khadi Cotton","Short Modern Cut","Environmentally Conscious","Functional Pockets"]'),
('kurta-07', 'Royal Wine Printed Silk Kurta', 'kurtas', 2999, 4499, 33, 'images/img-kurta-anarkali.jpg', 'images/img-kurta-blue.jpg', 'Silk Blend', 'Printed', 'Red', 4.6, 40, 'A premium wine-colored silk blend straight kurta featuring detailed golden prints, paired with matching cigarette pants.', '["Premium Silk Blend","Cigarette Pants Included","Metallic Zari Highlights","Comfortable Straight Fit"]'),
('kurta-08', 'Mint Meadow Cotton Suit Set', 'kurtas', 1899, 2799, 32, 'images/img-kurta-yellow.jpg', 'images/img-kurta-blue.jpg', 'Cotton', 'Printed', 'Green', 4.5, 58, 'A breezy mint green pure cotton suit set. Decorated with floral hand-prints and paired with light palazzos.', '["100% Organic Cotton","Hand-block Printing Style","Palazzo Pants Included","Perfect for Office Wear"]'),
('kurta-09', 'Golden Wheat Chanderi Salwar Suit', 'kurtas', 3599, 5499, 34, 'images/img-kurta-blue.jpg', 'images/img-kurta-anarkali.jpg', 'Chanderi', 'Chanderi Weave', 'Gold', 4.8, 32, 'A shimmering golden wheat-toned Chanderi suit. Boasts traditional border embroideries and comes with a sheer Chanderi dupatta.', '["Fine Chanderi Fabric","Sheer Chanderi Dupatta","Traditional Zari Embroidery","Perfect for Haldi & Festive Wear"]'),
('kurta-10', 'Rose Quartz Georgette Kurta', 'kurtas', 2599, 3899, 33, 'images/img-kurta-yellow.jpg', 'images/img-kurta-blue.jpg', 'Georgette', 'Printed', 'Pastel', 4.4, 18, 'A lovely rose pink georgette kurta featuring dynamic block prints and a flowy flare shape.', '["Georgette Base Material","Rose Pink Pastel Tint","Relaxed Flare Bottoms","Includes Chiffon Dupatta"]'),
('kurta-11', 'Classic Indigo Straight Kurta', 'kurtas', 2299, 3399, 32, 'images/img-kurta-blue.jpg', 'images/img-kurta-anarkali.jpg', 'Cotton', 'Printed', 'Blue', 4.5, 62, 'A straight fit indigo cotton kurta highlighting geometric block prints and a classic buttoned neck.', '["100% Organic Cotton","Indigo Hand-block Prints","Straight Casual Silhouette","High Color Fastness"]'),
('kurta-12', 'Pristine Khadi Cotton Suit Set', 'kurtas', 3199, 4899, 34, 'images/img-kurta-anarkali.jpg', 'images/img-kurta-yellow.jpg', 'Cotton', 'Khadi Weave', 'Off-White', 4.7, 41, 'An elegant, off-white suit set made from hand-spun Khadi cotton, pairing beautifully with floral printed bottoms.', '["Hand-spun Khadi Cotton","Floral Printed Bottoms","Lace Border Finishes","Eco-friendly Dyeing"]');

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password_hash) VALUES 
('admin', '$2y$10$/J.0NiW9VRmZvAJVecQC2eMxikm2o0.n7l/ChWJR9QTdkJbK//Dd.');

CREATE TABLE orders (
  id VARCHAR(50) PRIMARY KEY,
  customer_name VARCHAR(255) NOT NULL,
  items INT NOT NULL,
  amount DECIMAL(10, 2) NOT NULL,
  payment_method VARCHAR(50) NOT NULL,
  status VARCHAR(50) DEFAULT 'Processing',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
