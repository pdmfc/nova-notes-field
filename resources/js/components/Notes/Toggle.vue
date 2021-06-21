<template>
    <div class="my-1">
        <div
            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in"
        >
            <input
                type="checkbox"
                name="toggle"
                id="toggle"
                v-model="inputValue"
                @input="onInput"
                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                :style="toggleStyle"
            />
            <label
                for="toggle"
                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
            ></label>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Boolean,
            required: true,
        },
        icon: {
            type: String,
            default() {
                return 'check';
            },
        },
        noIcons: {
            type: Boolean,
            required: false,
        },
    },
    data() {
        return {
            inputValue: this.value,
            icons: {
                richText: {
                    on:
                        'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJoLTUgdy01IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGZpbGw9ImN1cnJlbnRDb2xvciI+CiAgPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBkPSJNNCA0YTIgMiAwIDAxMi0yaDQuNTg2QTIgMiAwIDAxMTIgMi41ODZMMTUuNDE0IDZBMiAyIDAgMDExNiA3LjQxNFYxNmEyIDIgMCAwMS0yIDJINmEyIDIgMCAwMS0yLTJWNHptMiA2YTEgMSAwIDAxMS0xaDZhMSAxIDAgMTEwIDJIN2ExIDEgMCAwMS0xLTF6bTEgM2ExIDEgMCAxMDAgMmg2YTEgMSAwIDEwMC0ySDd6IiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIC8+Cjwvc3ZnPg==',
                    off:
                        'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJoLTYgdy02IiBmaWxsPSJub25lIiB2aWV3Qm94PSIwIDAgMjQgMjQiIHN0cm9rZT0iY3VycmVudENvbG9yIj4KICA8cGF0aCBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIHN0cm9rZS13aWR0aD0iMiIgZD0iTTkgMTJoNm0tNiA0aDZtMiA1SDdhMiAyIDAgMDEtMi0yVjVhMiAyIDAgMDEyLTJoNS41ODZhMSAxIDAgMDEuNzA3LjI5M2w1LjQxNCA1LjQxNGExIDEgMCAwMS4yOTMuNzA3VjE5YTIgMiAwIDAxLTIgMnoiIC8+Cjwvc3ZnPg==',
                },
                private: {
                    on:
                        'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJoLTUgdy01IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGZpbGw9ImN1cnJlbnRDb2xvciI+CiAgPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBkPSJNMy43MDcgMi4yOTNhMSAxIDAgMDAtMS40MTQgMS40MTRsMTQgMTRhMSAxIDAgMDAxLjQxNC0xLjQxNGwtMS40NzMtMS40NzNBMTAuMDE0IDEwLjAxNCAwIDAwMTkuNTQyIDEwQzE4LjI2OCA1Ljk0MyAxNC40NzggMyAxMCAzYTkuOTU4IDkuOTU4IDAgMDAtNC41MTIgMS4wNzRsLTEuNzgtMS43ODF6bTQuMjYxIDQuMjZsMS41MTQgMS41MTVhMi4wMDMgMi4wMDMgMCAwMTIuNDUgMi40NWwxLjUxNCAxLjUxNGE0IDQgMCAwMC01LjQ3OC01LjQ3OHoiIGNsaXAtcnVsZT0iZXZlbm9kZCIgLz4KICA8cGF0aCBkPSJNMTIuNDU0IDE2LjY5N0w5Ljc1IDEzLjk5MmE0IDQgMCAwMS0zLjc0Mi0zLjc0MUwyLjMzNSA2LjU3OEE5Ljk4IDkuOTggMCAwMC40NTggMTBjMS4yNzQgNC4wNTcgNS4wNjUgNyA5LjU0MiA3IC44NDcgMCAxLjY2OS0uMTA1IDIuNDU0LS4zMDN6IiAvPgo8L3N2Zz4=',
                    off:
                        'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJoLTYgdy02IiBmaWxsPSJub25lIiB2aWV3Qm94PSIwIDAgMjQgMjQiIHN0cm9rZT0iY3VycmVudENvbG9yIj4KICA8cGF0aCBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIHN0cm9rZS13aWR0aD0iMiIgZD0iTTE1IDEyYTMgMyAwIDExLTYgMCAzIDMgMCAwMTYgMHoiIC8+CiAgPHBhdGggc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBzdHJva2Utd2lkdGg9IjIiIGQ9Ik0yLjQ1OCAxMkMzLjczMiA3Ljk0MyA3LjUyMyA1IDEyIDVjNC40NzggMCA4LjI2OCAyLjk0MyA5LjU0MiA3LTEuMjc0IDQuMDU3LTUuMDY0IDctOS41NDIgNy00LjQ3NyAwLTguMjY4LTIuOTQzLTkuNTQyLTd6IiAvPgo8L3N2Zz4=',
                },
                check: {
                    on:
                        'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJoLTUgdy01IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGZpbGw9ImN1cnJlbnRDb2xvciI+CiAgPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBkPSJNMTYuNzA3IDUuMjkzYTEgMSAwIDAxMCAxLjQxNGwtOCA4YTEgMSAwIDAxLTEuNDE0IDBsLTQtNGExIDEgMCAwMTEuNDE0LTEuNDE0TDggMTIuNTg2bDcuMjkzLTcuMjkzYTEgMSAwIDAxMS40MTQgMHoiIGNsaXAtcnVsZT0iZXZlbm9kZCIgLz4KPC9zdmc+',
                    off:
                        'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJoLTUgdy01IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGZpbGw9ImN1cnJlbnRDb2xvciI+CiAgPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBkPSJNNC4yOTMgNC4yOTNhMSAxIDAgMDExLjQxNCAwTDEwIDguNTg2bDQuMjkzLTQuMjkzYTEgMSAwIDExMS40MTQgMS40MTRMMTEuNDE0IDEwbDQuMjkzIDQuMjkzYTEgMSAwIDAxLTEuNDE0IDEuNDE0TDEwIDExLjQxNGwtNC4yOTMgNC4yOTNhMSAxIDAgMDEtMS40MTQtMS40MTRMOC41ODYgMTAgNC4yOTMgNS43MDdhMSAxIDAgMDEwLTEuNDE0eiIgY2xpcC1ydWxlPSJldmVub2RkIiAvPgo8L3N2Zz4=',
                }
            },
        };
    },
    watch: {
        value(newValue) {
            this.inputValue = newValue;
        },
    },
    methods: {
        onInput() {
            this.$emit('input', !this.value);
        },
    },
    computed: {
        toggleStyle() {
            if (!this.noIcons) {
                return {
                    backgroundImage: `url('data:image/svg+xml;base64, ${this.icons[this.icon][this.value === true ? "on" : "off"]}')`
                }
            }
        }
    }
};
</script>
<style>
/* CHECKBOX TOGGLE SWITCH */
/* @apply rules for documentation, these do not work as inline style */
.toggle-checkbox {
    border-color: #e2e8f0;
}

.toggle-checkbox:checked {
    @apply: right-0 border-green-400;
    right: 0;
    border-color: #68d391;
}

.toggle-checkbox:checked + .toggle-label {
    @apply: bg-green-400;
    background-color: #68d391;
}

.w-10 {
    width: 2.5rem;
}

.w-6 {
    width: 1.5rem;
}

.duration-200 {
    transition-duration: 0.2s;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}

.ease-in {
    transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
}

.transition {
    transition-property: background-color, border-color, color, fill, stroke,
        opacity, box-shadow, transform;
}
</style>
