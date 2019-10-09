module.exports = {
    theme: {
        extend: {
            colors: {
                'primary': '#1C154B',
                'secondary': '#07737C',
                'secondary-light': '#2E8D95',
                'secondary-dark': '#01626A',
            }
        }
    },
        variants: {},

    plugins: [
        require('@tailwindcss/custom-forms'),
    ]
}
