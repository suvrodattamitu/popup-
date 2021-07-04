import { createApp } from 'vue'
import App from './App.vue';

import {
  ElButton,
  ElButtonGroup,
  ElCol,
  ElCollapse,
  ElCollapseItem,
  ElCollapseTransition,
  ElColorPicker,
  ElDialog,
  ElForm,
  ElFormItem,
  ElIcon,
  ElImage,
  ElInput,
  ElInputNumber,
  ElOption,
  ElOptionGroup,
  ElPagination,
  ElRow,
  ElSelect,
  ElSlider,
  ElSwitch,
  ElTabPane,
  ElTable,
  ElTableColumn,
  ElTabs,
  ElLoading,
  ElMessage
} from 'element-plus';

const components = [
  ElButton,
  ElButtonGroup,
  ElCol,
  ElCollapse,
  ElCollapseItem,
  ElCollapseTransition,
  ElColorPicker,
  ElDialog,
  ElForm,
  ElFormItem,
  ElIcon,
  ElImage,
  ElInput,
  ElInputNumber,
  ElOption,
  ElOptionGroup,
  ElPagination,
  ElRow,
  ElSelect,
  ElSlider,
  ElSwitch,
  ElTabPane,
  ElTable,
  ElTableColumn,
  ElTabs,
]

const plugins = [
  ElLoading,
  ElMessage,
]

const app = createApp(App)

components.forEach(component => {
  app.component(component.name, component)
})

plugins.forEach(plugin => {
  app.use(plugin)
})

export default app;