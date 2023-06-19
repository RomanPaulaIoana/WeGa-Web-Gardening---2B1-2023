
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Flowers (
  ID_flower SERIAL PRIMARY KEY,
  Name VARCHAR(255) NOT NULL,
  Description TEXT,
  Price DECIMAL(10, 2),
  GrowthPeriod INT,
  ImageURL VARCHAR(255)
);
CREATE TABLE Orders (
  ID_order SERIAL PRIMARY KEY,
  ID_user INT REFERENCES Users(ID_user),
  ID_flower INT REFERENCES Flowers(ID_flower),
  Quantity INT,
  Completed BOOLEAN
);
CREATE TABLE Cultivations (
  ID_cultivation SERIAL PRIMARY KEY,
  ID_user INT REFERENCES Users(ID_user),
  ID_flower INT REFERENCES Flowers(ID_flower),
  StartDate DATE,
  LastWateringDate DATE,
  LastTemperatureAdjustment DATE,
  LastLightAdjustment DATE,
  Harvested BOOLEAN
);

CREATE TABLE subscribers(
  email varchar(255) NOT NULL
) ;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

CREATE TABLE favorites(
 ID_user INT REFERENCES Users(ID_user),
 ID_flower INT REFERENCES Flowers(ID_flower)
);
  
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- Inserare Daffodil
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Daffodil', 'Narcissus is a genus of predominantly spring flowering perennial plants of the amaryllis family, Amaryllidaceae. Various common names including daffodil, narcissus and jonquil, are used to describe all or some members of the genus. Narcissus has conspicuous flowers with six petal-like tepals surmounted by a cup- or trumpet-shaped corona. The flowers are generally white and yellow (also orange or pink in garden varieties), with either uniform or contrasting coloured tepals and corona.', 12.99, 3, ' styles/resources/daffodil.jpg');

-- Inserare Tulip
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Tulip', 'Tulips (Tulipa) are a genus of spring-blooming perennial herbaceous bulbiferous geophytes (having bulbs as storage organs). The flowers are usually large, showy and brightly coloured, generally red, pink, yellow, or white (usually in warm colours). They often have a different coloured blotch at the base of the tepals (petals and sepals, collectively), internally. Because of a degree of variability within the populations, and a long history of cultivation, classification has been complex and controversial. The tulip is a member of the lily family, Liliaceae, along with 14 other genera, where it is most closely related to Amana, Erythronium and Gagea in the tribe Lilieae.', 14.99, 7, ' styles/resources/tulip.jpg');

-- Inserare Crocus
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Crocus', 'Crocus is a genus of flowering plants in the iris family, comprising 90 species of perennials growing from corms. The flowers are cup-shaped, solitary, or in clusters, and range in color from pale lilac, mauve, yellow, or white, often with various shades of purple and violet markings at the base. Crocuses are native to woodland, scrub, and meadows from sea level to alpine tundra in North Africa, mainland Europe, and Asia.', 9.99, 4, ' styles/resources/Crocus.jpg');

-- Inserare Hyacinth
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Hyacinth', 'Hyacinthus is a small genus of bulbous, fragrant flowering plants in the family Asparagaceae, subfamily Scilloideae. These are commonly called hyacinths. The genus is native to the eastern Mediterranean (from south Turkey to northern Israel), north-east Iran, and Turkmenistan.', 11.99, 6, ' styles/resources/Hyacinth.jpg');

-- Inserare Anemone
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Anemone', 'Anemone is a genus of flowering plants in the family Ranunculaceae, native to temperate regions. The genus comprises about 120 species, including garden favourites like Japanese anemone. They are perennial herbaceous plants that grow from rhizomes or tubers. The flowers are diverse in colour and form.', 10.99, 5, ' styles/resources/Anemone.jpg');

-- Inserare Pansy
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Pansy', 'Pansy is a group of large-flowered hybrid plants cultivated as garden flowers. These are derived from species belonging to the Viola genus, including Viola tricolor, a wildflower found in Europe and western Asia. Pansies are known for their distinctive "faces", which include markings and patterns resembling human faces.', 7.99, 3, ' styles/resources/Pansy.jpg');

-- Inserare Iris
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Iris', 'Iris is a genus of flowering plants with showy flowers. It takes its name from the Greek word for a rainbow, which is also the name for the Greek goddess of the rainbow, Iris. Some authors state that the name refers to the wide variety of flower colors found among the many species, while others state that it refers to the wide variety of flower colors found within a single species. A common name for some species is "flags", while the plants of the subgenus Scorpiris are widely known as "junos", particularly in horticulture.', 9.99, 6, ' styles/resources/Iris.jpg');

-- Inserare Peony
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Peony', 'Peony is a genus of flowering plants in the family Paeoniaceae. They are native to Asia, Europe, and Western North America. The peony is named after Paeon, a student of Asclepius, the Greek god of medicine and healing. They are herbaceous perennial plants with large, showy flowers, and are highly valued in horticulture for their ornamental value.', 12.99, 8, ' styles/resources/Peony.jpg');

-- Inserare Azalea
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Azalea', 'Azalea is a genus of flowering shrubs in the family Ericaceae. They are native to several continents including Asia, Europe, and North America. Azaleas bloom in spring and their flowers often last several weeks. The flowers are usually large and showy, with a range of colors including white, pink, red, orange, purple, and yellow.', 10.99, 7, ' styles/resources/Azalea.jpg');

-- Inserare BlueBell
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Bluebell', 'Bluebell is a common name for plants in the genus Hyacinthoides. These plants are native to Western Europe and are particularly associated with ancient woodland. The flowers are bell-shaped and typically blue in color, although there are also pink and white varieties. Bluebells are known for their vibrant display during the spring season.', 8.99, 6, ' styles/resources/Bluebell.jpg');

-- Inserare Camellia
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Camellia', 'Camellia is a genus of flowering plants in the family Theaceae. They are native to East Asia, and are known for their showy flowers and glossy, dark green leaves. Camellias are often used in ornamental gardening, and there are thousands of cultivars available in a wide range of colors and forms.', 11.99, 7, ' styles/resources/Camellia.jpg');

-- Inserare Dahlia
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Dahlia', 'Dahlia is a genus of tuberous plants in the family Asteraceae. They are native to the highlands of Mexico and Central America, and are known for their large, showy flowers. Dahlia flowers come in a wide range of colors and forms, and are popular in garden beds and floral arrangements.', 9.99, 6, ' styles/resources/Dahlia.jpg');

-- Inserare Forsythia
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Forsythia', 'Forsythia is a genus of flowering plants in the family Oleaceae. They are native to East Asia and Southeast Europe. Forsythias are deciduous shrubs known for their bright yellow flowers that bloom in early spring. They are often used in landscaping and can be grown as hedges or standalone plants.', 8.99, 5, ' styles/resources/Forsythia.jpg');

-- Inserare Freesia
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Freesia', 'Freesia is a genus of flowering plants in the family Iridaceae. They are native to South Africa and are popular for their fragrant flowers. Freesias come in a range of colors including white, yellow, orange, pink, and lavender. They are commonly used in floral arrangements and as garden plants.', 7.99, 4, ' styles/resources/Freesia.jpg');

-- Inserare Grape hyacinth
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Grape hyacinth', 'Grape hyacinth is a small bulbous perennial plant in the genus Muscari, native to Eurasia. The flowers resemble bunches of grapes and are typically blue or purple in color. Grape hyacinths are popular in gardens and are known for their early spring blooms.', 6.99, 3, ' styles/resources/Grape_hyacinth.jpg');
-- Inserare Magnolia
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Magnolia', 'Magnolia is a large genus of flowering trees and shrubs in the family Magnoliaceae. They are native to Asia, North and Central America, and the West Indies. Magnolias are known for their large, fragrant flowers that come in various colors, including white, pink, and purple. They are popular ornamental plants in gardens and parks.', 14.99, 9, ' styles/resources/Magnolia.jpg');

-- Inserare Lily of the valley
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Lily of the valley', 'Lily of the valley is a fragrant, low-growing perennial plant in the genus Convallaria. It is native to Europe and has bell-shaped white flowers that hang from a thin, arching stem. Lily of the valley is known for its sweet scent and is often used in bridal bouquets and perfumes.', 7.99, 4, ' styles/resources/Lily_of_the_valley.jpg');

-- Inserare Marigold
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Marigold', 'Marigold is a genus of annual and perennial flowering plants in the family Asteraceae. They are native to the Americas and are cultivated for their bright, daisy-like flowers. Marigolds come in various colors, including yellow, orange, and red. They are often used as decorative plants in gardens and are believed to have insect-repellent properties.', 6.99, 3, ' styles/resources/Marigold.jpg');

-- Inserare Transvaal daisy
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Transvaal daisy', 'Transvaal daisy, also known as Gerbera daisy, is a genus of flowering plants in the family Asteraceae. They are native to South Africa and are popular for their large, colorful flowers. Transvaal daisies come in a wide range of colors, including red, orange, yellow, pink, and white. They are often used in floral arrangements and as potted plants.', 8.99, 5, ' styles/resources/transvaal_daisy.jpg');
-- Inserare Sweet pea
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Sweet pea', 'Sweet pea is a flowering plant in the genus Lathyrus. It is native to the Mediterranean region and is known for its delicate, fragrant flowers that come in various colors, including pink, purple, and white. Sweet peas are popular garden plants and are often grown for their beautiful blooms and sweet fragrance.', 9.99, 6, ' styles/resources/sweet_pea.jpg');

-- Inserare Primrose
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Primrose', 'Primrose is a genus of flowering plants in the family Primulaceae. They are native to Europe, Asia, and North America and are known for their colorful flowers that bloom in early spring. Primroses come in a variety of colors, including yellow, pink, purple, and white. They are often used as ornamental plants in gardens and are a symbol of spring.', 5.99, 2, ' styles/resources/Primrose.jpg');

-- Inserare Rose
INSERT INTO Flowers (Name, Description, Price, GrowthPeriod, ImageURL)
VALUES ('Rose', 'Rose is a woody perennial flowering plant in the family Rosaceae. It is native to various regions of the world and is known for its beautiful and fragrant flowers. Roses come in a wide range of colors, sizes, and shapes, and they have been cultivated for centuries for their ornamental value. Roses are often associated with love and are a popular choice for bouquets and gardens.', 11.99, 8, 'styles/resources/rose.jpg');
SELECT* FROM FLOWERS;
