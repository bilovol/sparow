/**
 * @param {String} mode
 */
export async function switchAutomationGrid(mode) {
    document.getElementById('automation').className = mode;
}
