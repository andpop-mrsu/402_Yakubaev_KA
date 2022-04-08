import Fraction from '../src/index';

test('getNumer', () => {
	expect(new Fraction(3, 2).getNumer()).toBe(3);
});

test('getDenom', () => {
	expect(new Fraction(3, 2).getDenom()).toBe(2);
});

test('add', () => {
	const frac1 = new Fraction(1, 2);
	const frac2 = new Fraction(1, 3);
	expect(frac1.add(frac2).toString()).toBe('5/6');
});

test('sub', () => {
	const frac1 = new Fraction(2, 3);
	const frac2 = new Fraction(1, 3);
	expect(frac1.sub(frac2).toString()).toBe('1/3');
});

test('toString', () => {
	expect(new Fraction(3, 2).toString()).toBe('1\'1/2');
});