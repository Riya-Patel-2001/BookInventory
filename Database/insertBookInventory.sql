INSERT INTO bookInventory VALUES
(null, 'Basic Mathematics','Pragati Agrawal', 7, 30, load_file('maths.png')),
(null, 'Think like a monk', 'Jay Shetty',5,24,load_file('monk.png')),
(null, 'PHP','Kevin Tatroe', 8,20,load_file('php.png')),
(null, 'Rich Dad Poor Dad', 'Robert kiyosaki',12,32,load_file('dad.png')),
(null, 'The everyday hero manifesto','Robin Sharma' ,9,21,load_file('everyday.png'));


INSERT INTO bookinventory VALUES
(null, 'As a Man Thinketh','James allen' ,20,19,load_file('man.png'));

delete from bookinventory where bookId=8;
