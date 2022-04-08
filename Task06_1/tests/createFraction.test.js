import createFraction from '../src/index.js';

test('getNumer', () => {
	expect(createFraction(3, 2).getNumer()).toBe(3);
});

test('getDenom', () => {
	expect(createFraction(3, 2).getDenom()).toBe(2);
});

test('add', () => {
	const frac1 = createFraction(1, 2);
	const frac2 = createFraction(1, 3);
	expect(frac1.add(frac2).toString()).toBe('5/6');
});

test('sub', () => {
	const frac1 = createFraction(2, 3);
	const frac2 = createFraction(1, 3);
	expect(frac1.sub(frac2).toString()).toBe('1/3');
});

test('toString', () => {
	expect(createFraction(3, 2).toString()).toBe('1\'1/2');
});