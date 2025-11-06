import './bootstrap';
import { initMultiSelect, initDependentMultiSelect } from './components/multi-select';
import { initToggleSwitch } from './components/toggle-switch';

// Make components globally available
window.initMultiSelect = initMultiSelect;
window.initDependentMultiSelect = initDependentMultiSelect;
window.initToggleSwitch = initToggleSwitch;
