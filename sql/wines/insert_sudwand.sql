INSERT INTO wines (
	title, sort, harvest, age, residual_sugar, acidity, area, image
	) 
VALUES (
	'Sudwand', 'Risling, 100%', 2018, 2, 11.5, 5.3, 'German, Mosel', 
	LOAD_FILE('/Users/likhobabin_im/ws/sys/laravel/sites/steilgut_s.test001/sql/wines/images/bottle_sudwand_001.png')
	);