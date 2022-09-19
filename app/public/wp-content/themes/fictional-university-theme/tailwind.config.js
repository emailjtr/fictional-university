/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
		"./template-parts/**/*.php",
	    "./*.php",
        "./js/*.js"
    ],
	theme: {
		extend: {},
	},
	plugins: [
        require('@tailwindcss/typography')
   ],
}